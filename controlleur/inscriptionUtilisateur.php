<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 10/01/2018
 * Time: 12:29
 */


require_once('ConnectPDO.php');

$bd = null;
$dsn = "mysql:dbname=apero;host=localhost";
$user = "root";
$password = "";


$nom = null;
$prenom = null;
$email = null;
$mdp = null;
$ville= null;
$adresse = null;
$cp = null;
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

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']))
{
    $nom = test_input($_POST['nom']);
    if(!preg_match("/^[a-zA-Z]*$/", $nom))
    {
        $err = "errNom";
    }
    $prenom = test_input($_POST['prenom']);
    if(!preg_match("/^[a-zA-Z]*$/", $prenom))
    {
        $err = "errPrenom";
    }
    $email = test_input($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $err = "errEmail";
    }
    $mdp = test_input($_POST['mdp']);

    // verifier que l'utilisateur n'existe pas déjà dans la base de donée
    $verifierUtilisateurExiste = "SELECT numUtilisateur FROM utilisateur WHERE mail = :email";

    $resExist = $bd->prepare($verifierUtilisateurExiste);

    $resExist->execute(array(
        'email' => $email
    ));

    $row = $resExist->fetchAll();

    if($row)
    {
        $err = "errExist";
    } else if(is_null($err))
    {
        $sqlUtilisateur = "INSERT INTO utilisateur VALUES ('', 'parentUtilisateur', '$nom', '$prenom', '$email', '$mdp', NULL , NULL, NULL )";

        $resUtilisateur = $bd->prepare($sqlUtilisateur);

        $resUtilisateur->execute();
    }
}

if(is_null($err))
{
    header("Location: ../vue/espace_personnel_president.php?err=noError");
} else
{
    header("Location: ../vue/espace_personnel_president.php?err=$err");
}



?>