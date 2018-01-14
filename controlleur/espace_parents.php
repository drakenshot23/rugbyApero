<?php
/**
 * Created by IntelliJ IDEA.
 * User: anthony
 * Date: 05/01/2018
 * Time: 16:35
 */


require_once('ConnectPDO.php');

session_start();

$donnesEnfants = "SELECT numEnfant, nom FROM enfant WHERE numUtilisateur = :numUtilisateur";

$soldeEnfant = "SELECT montant FROM compte WHERE numUtilisateur = :numUtilisateur and numEnfant = :numEnfant";


$inscrireEnfant = "INSERT INTO enfant VALUES('', :nomEnfant, :prenomEnfant, :ageEnfant, :telParent, :mailParent, :libelleCategorie, :numUtilisateur, :numCategorie)";

$ajoutArgent = "INSERT INTO compte VALUES('', date(), :montant, :numUtilisateur, :numEnfant)";

$id = null;
$idEnfant = null;
$nom = null;
$mail = null;

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

if(isset($_SESSION['id']) && isset($_SESSION['nom']) && isset($_SESSION['mail']))
{
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
    $mail = $_SESSION['mail'];
}

// Si le contenu est vide alors on envoie une erreur
if(empty(stripslashes(file_get_contents("php://input"))))
{
    $err = json_encode($err);
    echo $err;
} else
{
    $data = json_decode(stripslashes(file_get_contents("php://input")), true);
    if($data['commande'] == "inscription")
    {
        $prenomEnfant = $data['prenom'];

        $verifierEnfantExiste = "SELECT numEnfant FROM enfant WHERE numUtilisateur= :id AND prenom = :prenom";
        $resExist = $bd->prepare($verifierEnfantExiste);
        $resExist->execute(array(
            'id' => $id,
            'prenom' => $prenomEnfant
        ));
        $row = $resExist->fetchALL();

        if($row){
            $err = "L'enfant existe";
            echo json_encode($err);
        }
        else {

            $nomEnfant = $data['nom'];
            $age = $data['age'];
            $telParent = $data['telParent'];
            $categorie = $data['categorie'];

            $sqlEnfant = "INSERT INTO ENFANT VALUES ('','$nomEnfant','$prenomEnfant','$age','$telParent','$mail','$categorie','$id')";
            $ressqlEnfant = $bd->prepare($sqlEnfant);
            $ressqlEnfant->execute();


            $verifierEnfantExiste2 = "SELECT numEnfant FROM enfant WHERE numUtilisateur = :id AND prenom = :prenom";
            $resExist2 = $bd->prepare($verifierEnfantExiste2);
            $resExist2->execute(array(
                'id' => $id,
                'prenom' => $prenomEnfant
            ));
            $idEnfant = $resExist2->fetchAll();

            if ($idEnfant) {
                $date= date();
                $sqlCompte = "INSERT INTO COMPTE VALUES ('','$date',0,'$id','$idEnfant')";
                $ressqlCompte = $bd->prepare($sqlCompte);
                $ressqlCompte->execute();

                $sqlAfficher = "SELECT e.numEnfant, e.prenom, SUM(montant) AS solde FROM enfant e, compte c GROUP BY e.numEnfant, e.prenom";
                $resAfficher = $bd->prepare($sqlAfficher);
                $resAfficher->execute();
                echo json_encode($resAfficher->fetchAll());

            } else {
                $err = "Enfant pas ajouté";
                echo json_encode($err);
            }
        }

    } else if($data['commande'] == "ajouterArgent") {

        $date= date();
        $montant = $data['montant'];
        $numEnfant = $data['numEnfant'];

        $sql ="INSERT INTO COMPTE VALUES('','$date','$montant','$id','$numEnfant')";
        $sqlAjouter = $bd->prepare($sql);
        $sqlAjouter->execute();

        $sqlAfficher = "SELECT e.numEnfant, e.prenom, SUM(montant) AS solde FROM enfant e, compte c GROUP BY e.numEnfant, e.prenom";
        $resAfficher = $bd->prepare($sqlAfficher);
        $resAfficher->execute();

        echo json_encode($resAfficher->fetchAll());

    }else if ($data['commande'] == "afficherEnfant"){

        $sqlAfficher = "SELECT e.numEnfant, e.prenom, SUM(montant) AS solde FROM enfant e, compte c GROUP BY e.numEnfant, e.prenom";
        $resAfficher = $bd->prepare($sqlAfficher);
        $resAfficher->execute();

        echo json_encode($resAfficher->fetchAll());

    }else if (($data['commande'] == "supprimerEnfant")){
        $id = $data['numEnfant'];

        $sqlDeleteC = $bd->prepare("DELETE FROM COMPTE WHERE numEnfant = $id");
        $sqlDeleteC->execute();

        $sqlDeleteE = $bd->prepare("DELETE FROM ENFANT WHERE numEnfant = $id");
        $sqlDeleteE->execute();
        //Manque le test pour savoir si le solde = 0 et qui est une condition pour supprimer le compte
    }
}

?>