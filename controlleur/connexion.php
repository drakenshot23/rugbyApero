<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 29/12/2017
 * Time: 13:00
 */

require_once("ConnectPDO.php");

$bd = null;
$dsn = "mysql:dbname=apero;host=localhost";
$user = "root";
$password = "";


$email = null;
$mdp = null;
$err = null;

// traiter tous les cas d'erreur de saisie de la part de l'utilisateur
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}


try
{
    $bd = ConnectPDO::getInstanceBD($dsn, $user, $password);
} catch(PDOException $e)
{
    echo "Connexion à la base de donnée échouée : " . $e->getMessage();
}

if(isset($_POST['email']) && isset($_POST['mdp']))
{
    $email = test_input($_POST['email']);

    $mdp = test_input($_POST['mdp']);

    $verifierUtilisateurExiste = "SELECT numUtilisateur FROM utilisateur WHERE mail = :email AND mdp = :mdp";

    $resExist = $bd->prepare($verifierUtilisateurExiste);

    $resExist->execute(array(
        'email' => $email,
        'mdp' => $mdp));

    $row = $resExist->fetchAll();

    if($row)
    {
        echo "Bienvenue dans votre espace utilisateur";
    } else
    {
        $err = "errInscrit";
    }
}

if(!is_null($err))
{
    header("Location: ../vue/formulaire_connexion.php?err=$err");
}

?>