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
    if($data['commande'] == "ajouterProduit")
    {
        $nomProduit = $data['nomProduit'];

        $sql = "SELECT numProduit FROM PRODUIT WHERE nomProduit = :nomProduit ";
        $verifProduit = $bd->prepare($sql);
        $verifProduit->execute(array(
            'nomProduit' => $nomProduit
        ));;
        $row = $verifProduit>fetchALL();

        if ($row){
            $err = "Produit déja existant";
            echo json_encode($err);
        }
        else {

            $nomProduit = $data['nomProduit'];
            $prix = $data['prix'];
            $qteProduit = $data['qteProduit'];
            $seuilRupture = $data['seuilRupture'];

            $sql2 = "INSERT INTO PRODUIT VALUES('','$nomProduit','$prix','$qteProduit','$seuilRupture',NULL)";
            $ajouterPRoduit = $bd->prepare($sql2);
            $ajouterPRoduit->execute();

            $sql3 = "SELECT numProduit FROM PRODUIT WHERE nomProduit = :nomProduit ";
            $verifProduit2 = $bd->prepare($sql3);
            $verifProduit2->execute(array(
                'nomProduit' => $nomProduit
            ));;
            $tabProduit = $verifProduit2->fetchALL();

            if($tabProduit){

                $numProduit = $tabProduit['numProduit'];
                $qteProduit = $data['qteProduit'];
                $bd->execute("INSERT INTO STOCK VALUES('','$qteProduit','$numProduit')");


                $bd->prepare("SELECT numStock FROM STOCK WHERE nomProduit = :nomProduit");
                $bd->execute(array(
                    'nomProduit' => $nomProduit
                ));;
                $row3 = $bd>fetchAll();

                if(row3){
                    $bd->execute("SELECT nomProduit, prix FROM PRODUIT ");
                    echo json_encode($bd->fetchAll());
                }
                else {
                    $err = "Produit non ajouté au stock";
                    echo json_encode($err);
                }
            }
            else {
                $err = "Produit non crée";
                echo json_encode($err);
            }
        }

    } else if($data['commande'] == "fixerPrix")
    {
        $prix = $data['prix'];
        $nomP = $data['nom'];
        $bd->prepare("UPDATE PRODUIT SET prix = $prix WHERE nom = :nomP");
        $bs->execute(array(
            'nomP' => $nomProduit
        ));;

        $stmt = $bd->prepare("SELECT nomProduit, prix FROM PRODUIT ");
        $stmt->execute();
        echo json_encode($stmt->fetchAll());
    }

    else if($data['commande'] == "supprimerUtilisateur")
    {
        $bd->prepare("DELETE FROM UTILISATEUR WHERE mail = :mail");
        $bs->execute(array(
            'mail' => $data['mail']
        ));;
    }
    else if($data['commande'] == "reinitBD")
    {
        $bd->execute("DELETE FROM PRODUIT");
        $bd->execute("DELETE FROM STOCK");
        $bd->execute("DELETE FROM ENFANT");
        $bd->execute("DELETE FROM COMPTE");
        $bd->execute("DELETE FROM COMPOSITION]");
        $bd->execute("DELETE FROM COURSE");
        $bd->execute("DELETE FROM UTILISATEUR WHERE typeGestiobnnaire = 'parenUtilisateur' OR typeGestionnaire ='parent'");
    }
    else if ($data['commande'] == "afficherProduit"){

        $stmt = $bd->prepare("SELECT nomProduit, prix FROM PRODUIT ");
        $stmt->execute();
        echo json_encode($stmt->fetchAll());

    }

}
?>