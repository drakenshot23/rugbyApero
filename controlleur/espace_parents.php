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


$inscrireEnfant = "INSERT INTO enfant VALUES('', :nomEnfant, :prenomEnfant, :ageEnfant, :telParent, :mailParent, :libelleCategorie, :numUtilisateur, :numCategorie)";

$ajoutArgent = "INSERT INTO compte VALUES('', date(), :montant, :numUtilisateur, :numEnfant)";

$id = null;
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

if(isset($_SESSION['id']) && isset($_SESSION['nom'] && isset($_SESSION['mail'])))
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
        inscription($data, $mail,$id,$bd);
    } else if($data['commande'] == "ajouter")
    {
        ajouterArgent($data);
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
    $stmt->binParam(6, $data['libelleCategorie']);
    $stmt->binParam(7, $id);

    $stmt->execute();
}

function ajouterArgent($donnees)
{

}

?>


<?php
$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (?, ?)");
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $value);

// insertion d'une ligne
$name = 'one';
$value = 1;
$stmt->execute();

// insertion d'une autre ligne avec différentes valeurs
$name = 'two';
$value = 2;
$stmt->execute();
?>









<?php
/* Exécute une requête préparée en passant un tableau de valeurs */
$sql = 'SELECT nom, couleur, calories
    FROM fruit
WHERE calories < :calories AND couleur = :couleur';
$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array(':calories' => 150, ':couleur' => 'red'));
$red = $sth->fetchAll();
$sth->execute(array(':calories' => 175, ':couleur' => 'yellow'));
$yellow = $sth->fetchAll();
?>

