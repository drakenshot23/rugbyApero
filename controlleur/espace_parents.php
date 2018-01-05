<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 05/01/2018
 * Time: 16:35
 */

session_start();

$donnesEnfants = "SELECT numEnfant, nom FROM enfant WHERE numUtilisateur = :numUtilisateur";

$soldeEnfant = "SELECT montant FROM compte WHERE numUtilisateur = :numUtilisateur and numEnfant = :numEnfant";

$ajoutCategorie = "INSERT INTO categorie VALUES('', :libelleCategorie)";

$inscrireEnfant = "INSERT INTO enfant VALUES('', :nomEnfant, :prenomEnfant, :ageEnfant, :telParent, :mailParent, :libelleCategorie, :numUtilisateur, :numCategorie)";

$ajoutArgent = "INSERT INTO compte VALUES('', date(), :montant, :numUtilisateur, :numEnfant)";


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
} else
{
    $data = json_decode(stripslashes(file_get_contents("php://input")), true);
    if($data['commande'] == "inscription")
    {
        inscription($data);
    } else if($data['commande'] == "ajouter")
    {
        ajouterArgent($data);
    }

}

$id = null;
$nom = null;

function inscription($donnees)
{

}

function ajouterArgent($donnees)
{

}

?>