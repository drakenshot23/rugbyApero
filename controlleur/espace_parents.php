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
            echo json_encode($err);
        }
        else {

            $nomEnfant = $data['nom'];
            $age = $data['age'];
            $telParent = $data['telParent'];
            $categorie = $data['categorie'];

            $sql = "INSERT INTO ENFANT VALUES ('','$nomEnfant','$prenomEnfant','$age','$telParent','$mail','$categorie','$id'";
            $ressql = $bd->prepare($sql);
            $ressql->execute();

            $verifierEnfantExiste2 = "SELECT numEnfant FROM enfant WHERE numUtilisateur = :id AND prenom = :prenom";
            $resExist2 = $bd->prepare($verifierEnfantExiste2);
            $resExist2->execute(array(
                'id' => $id,
                'prenom' => $prenomEnfant
            ));
            $idEnfant = $resExist2->fetchAll();

            if ($idEnfant) {

                $sqlAfficher = "SELECT e.numEnfant, e.prenom, SUM(montant) AS solde FROM enfant e, compte c GROUP BY e.numEnfant, e.prenom";
                $resAfficher = $bd->prepare($sqlAfficher);
                $resAfficher->execute(array(
                    'id' => $id,
                    'idEnfant' => $idEnfant
                ));
                echo json_encode($resAfficher->fetchAll());

            } else {
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

    }
}

?>