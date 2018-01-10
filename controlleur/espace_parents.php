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

    $stmt = $bd->prepare("INSERT INTO ENFANT VALUES(?,?,?,?,?,?,?)");
    $stmt->binParam(1, $data['nom']);
    $stmt->binParam(2, $data['prenom']);
    $stmt->binParam(3, $data['age']);
    $stmt->binParam(4, $data['telParent']);
    $stmt->binParam(5, $mail);
    $stmt->binParam(6, $data['categorie']);
    $stmt->binParam(7, $id);

    $stmt->execute();

    $idEnfant = $bd->execute("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id ");
    afficherEnfant($bd,$id,$idEnfant);
}

function ajouterArgent($data,$id,$bd, $idEnfant,$date)
{

    $stmt = $bd->prepare("INSERT INTO COMPTE VALUES(?,?,?,?)");
    $stmt->binParam(1, $date);
    $stmt->binParam(2, $data['montant']);
    $stmt->binParam(3, $id);
    $stmt->binParam(4, $idEnfant);

    $idEnfant = $bd->execute("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id ");

    $stmt->execute();
}

function afficherEnfant($bd,$id,$idEnfant){
    $stmt = $bd->prepare("SELECT E.numEnfant, E.prenom, SUM(montant) AS solde FROM ENFANT E, COMPTE C where E.numUtilisateur = $id AND C.numEnfant = $idEnfant");
    $stmt->execute();
    $tab = json_encode($stmt->fetchAll());
    echo $tab;
}
?>