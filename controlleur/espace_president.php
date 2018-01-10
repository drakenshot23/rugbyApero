<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 08/01/2018
 * Time: 09:43
 */

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
    if($data['commande'] == "ajoutProduit")
    {
        ajoutProduit($data,$bd);
    } else if($data['commande'] == "fixerPrix")
    {
        fixerPrix($data,$bd);
    }

    else if($data['commande'] == "supprimerUtilisateur")
    {
        supprimerUtilisateur($data,$bd);
    }
    else if($data['commande'] == "reinitBD")
    {
        reinitBD($bd);
    }

}

function ajoutProduit($data,$bd)
{

    $stmt = $bd->prepare("INSERT INTO PRODUIT VALUES(?,?,?,?)");
    $stmt->binParam(1, $data['nomProduit']);
    $stmt->binParam(2, $data['prix']);
    $stmt->binParam(3, $data['qteProduit']);
    $stmt->binParam(4, $data['seuilRupture']);


    $stmt->execute();

    $stmt2 = $bd->prepare("INSERT INTO STOCK VALUES(?,?)");
    $stmt2->binParam(1, $data['nomProduit']);
    $stmt2->binParam(2, $data['prix']);

    $stmt2->execute();

    $res = aficherproduit($bd);
    echo $res;
}

function fixerPrix($data,$bd)
{
    $prix = $data['prix'];
    $nomP = $data['nom'];
    $bd->execute("UPDATE PRODUIT SET prix = $prix WHERE nom = $nomP");
}


function reinitBD($bd){
    $bd->execute("DELETE FROM PRODUIT");
    $bd->execute("DELETE FROM STOCK");
    $bd->execute("DELETE FROM ENFANT");
    $bd->execute("DELETE FROM COMPTE");
    $bd->execute("DELETE FROM COMPOSITION]");
    $bd->execute("DELETE FROM COURSE");
    $bd->execute("DELETE FROM UTILISATEUR WHERE typeGestiobnnaire = 'parenUtilisateur' OR typeGestionnaire ='parent'");


}

function supprimerUtilisateur($data,$bd){

    $mailU = $data['mail'];
    $bd->execute("DELETE FROM UTILISATEUR WHERE mail = $mailU]");


}

function aficherproduit($bd){

    $stmt = $bd->prepare("SELECT nomProduit, prix FROM PRODUIT ");
    $stmt->execute();
    $tab = json_encode($stmt->fetchAll());
    return $tab;
}