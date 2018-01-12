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
    if($data['commande'] == "ajouterCourse")
    {


    } else if($data['commande'] == "gouter")
    {

    }


}

?>