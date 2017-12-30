<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 29/12/2017
 * Time: 13:00
 */
require_once('ConnectPDO.php');

$dsn = "mysql:dbname=apero;host=localhost";
$user = "root";
$password = "";

try
{
    $bd = ConnectPDO::getInstanceBD($dsn, $user, $password);
} catch(PDOException $e)
{
    echo "Connexion échouée : " . $e->getMessage();
}

$nom = null;
$prenom = null;
$email = null;
$mdp = null;
$ville= null;
$adresse = null;
$cp = null;


if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["mdp"]) && isset($_POST["ville"]) && isset($_POST["adresse"])
    && isset($_POST["cp"]))
{
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $ville = $_POST["ville"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
}

$sqlUtilisateur = "INSERT INTO utilisateur VALUES ('', 'parent', '$nom', '$prenom', '$email', '$mdp', '$ville', '$adresse', '$cp')";

$pdoStatement = $bd->prepare($sqlUtilisateur);

$pdoStatement->execute();

// Creer fonction insetion utilisateur
// verifier que l'utilisateur n'existe pas déjà dans la base de donée
// traiter tous les cas d'erreur de saisie de la part de l'utilisateur



?>