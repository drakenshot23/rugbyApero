<?php
/**
 * Created by IntelliJ IDEA.
 * User: anthony
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

// eliminer les caracteres non autorisees
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

    $verifierUtilisateurExiste = "SELECT numUtilisateur,typeGestionnaire, nom FROM utilisateur WHERE mail = :email AND mdp = :mdp";

    $resExist = $bd->prepare($verifierUtilisateurExiste);

    $resExist->execute(array(
        'email' => $email,
        'mdp' => $mdp));

    $row = $resExist->fetchAll(PDO::FETCH_ASSOC);

    if($row)
    {
        session_start();
        $_SESSION['id'] = $row[0]['numUtilisateur'];
        $_SESSION['nom'] = $row[0]['nom'];
        $_SESSION['type'] = $row[0]['typeGestionnaire'];
        $_SESSION['mail'] = $_POST['email'];

        if (row[0]['typeGestionnaire']=='parent'){
            header("Location: ../vue/espace_personnel_parents.php");
        }
        else if (row[0]['typeGestionnaire']=='parenUtilisateur'){
            header("Location: ../vue/espace_personnel_utilisateur.php");
        }
        else if  (row[0]['typeGestionnaire']=='presidentApero'){
            header("Location: ../vue/espace_personnel_president.php");
        }
        header("Location: ../index.php");
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