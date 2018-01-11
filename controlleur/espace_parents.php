<?php
/**
 * Created by IntelliJ IDEA.
 * User: anthony
 * Date: 05/01/2018
 * Time: 16:35
 */

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
        inscription($data, $mail,$id,$bd, $idEnfant);
    } else if($data['commande'] == "ajouter")
    {
        $date = date();
        ajouterArgent($data,$id,$bd,$date);
    }
}


function inscription($data, $mail, $id,$bd)
{
    $prenom = $data['prenom'];
    $nom2 = $data['nom'];
    $stmt = $bd->prepare("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id AND nom = $nom2 AND prenom = $prenom");
    $stmt->execute();
    $row = $stmt->fetchAll();

    if($row){
        echo "err"; //existe dans la BD
    }
    else {

        $stmt2 = $bd->prepare("INSERT INTO ENFANT VALUES(?,?,?,?,?,?,?)");
        $stmt2->binParam(1, $data['nom']);
        $stmt2->binParam(2, $data['prenom']);
        $stmt2->binParam(3, $data['age']);
        $stmt2->binParam(4, $data['telParent']);
        $stmt2->binParam(5, $mail);
        $stmt2->binParam(6, $data['categorie']);
        $stmt2->binParam(7, $id);

        $stmt2->execute();

        $prenom = $data['prenom'];
        $stmt3 = $bd->prepare("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id AND prenom = $prenom");
        $stmt3->execute();
        $idEnfant = $stmt3->fetchAll();

        if ($idEnfant) {
            $res = afficherEnfant($bd, $id, $idEnfant);
            echo $res;
        } else {
            echo "err";
        }

    }

}

function ajouterArgent($data,$id,$bd, $idEnfant,$date)
{

    $stmt = $bd->prepare("INSERT INTO COMPTE VALUES(?,?,?,?)");
    $stmt->binParam(1, $date);
    $stmt->binParam(2, $data['montant']);
    $stmt->binParam(3, $id);
    $stmt->binParam(4, $idEnfant);

    $idEnfant = $bd->execute("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id");

    $stmt->execute();

}

function afficherEnfant($bd,$id,$idEnfant){
    $stmt = $bd->prepare("SELECT E.numEnfant, E.prenom, SUM(montant) AS solde FROM ENFANT E, COMPTE C where E.numUtilisateur = $id AND C.numEnfant = $idEnfant");
    $stmt->execute();
    $tab = json_encode($stmt->fetchAll());
    return $tab;
}
?>