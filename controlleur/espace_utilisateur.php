<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 08/01/2018
 * Time: 09:43
 */

require_once('ConnectPDO.php');

session_start();


$id = null;
$nom = null;

$err = 'erreur';
$data = null;

$bd = null;
$dsn = "mysql:dbname=apero;host=localhost";
$user = "root";
$password = "";

try
{
    $bd = ConnectPDO::getInstanceBD($dsn, $user, $password);
} catch(PDOException $e)
{
    echo "Connexion à la base de donnée échouée : " . $e->getMessage();
}

if(isset($_SESSION['id']) && isset($_SESSION['nom']))
{
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
}

// Si le contenu est vide alors on envoie une erreur
if(empty(stripslashes(file_get_contents("php://input"))))
{
    $err = json_encode($err);
    echo $err;
}
else {
    $data = json_decode(stripslashes(file_get_contents("php://input")), true);
    if($data['commande'] == "ajouterCourse")
    {
        $date = date();
        $montantCourse = $data['montant'];

        $sql = "INSERT INTO COURSE VALUES('','$montantCourse','$date','$id')";
        $ajouterCourse = $bd->prepare($sql);
        $ajouterCourse->execute();



    } else if($data['commande'] == "gouter")
    {
        $sql="SELECT numProduit FROM PRODUIT WHERE nomProduit = :nomProduit";
        $rechercherProduit = $bd->prepare($sql);
        $rechercherProduit->execute(array(
            'nomProduit' => $data['nomProduit']
        ));;
        $numProduit = $rechercherProduit->fetchAll();

        $sql2 = "SELECT numEnfant FROM ENFANT WHERE nom = :nomEnfant AND prenom = :prenomEnfant";
        $rechercherEnfant = $bd->prepare($sql2);
        $rechercherEnfant->execute(array(
            'nomEnfant' => $data['nomEnfant'],
            'prenomEnfant' => $data['prenomEnfant']
        ));;
        $numEnfant = $rechercherEnfant->fetchAll();

        $sql3 = "SELECT numCompte FROM ENFANT WHERE  numEnfant = $numEnfant";
        $rechercherCompte = $bd->prepare($sql3);
        $rechercherCompte->execute();
        $numCompte = $rechercherCompte->fetchAll();

        $sql3 = "INSERT INTO COMPOSITION VALUES ('','$numCompte','$numProduit')";
        $insererCompo = $bd->prepare($sql3);
        $insererCompo->execute();

        $sql4 = "SELECT prix FROM PRODUIT WHERE numProduit = $numProduit";
        $rechercherPrix = $bd->prepare($sql4);
        $rechercherPrix->execute();
        $prix = $rechercherPrix->fetchAll();

        $prix = 0  - $prix;


        $sql5 = "INSERT INTO COMPTE VALUES('','$date','$prix','$id','$numUtilisateur' )";
        $ajouterCompte = $bd->prepare($sql5);
        $ajouterCompte->execute();

        $sql6 = "UPDATE STOCK SET qteProduit = qteProduit - 1 WHERE numProduit = $numProduit";
        $majStock = $bd->prepare();
        $majStock = $bd->execute();

    }

}

?>