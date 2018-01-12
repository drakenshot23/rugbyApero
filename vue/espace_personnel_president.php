<?php
/**
 * Created by IntelliJ IDEA.
 * User: Antho
 * Date: 02/01/2018
 * Time: 23:24
 */
session_start();

if(empty($_SESSION))
{
    header("Location: ../index.php");
}

$id = null;
$nom = null;

if(isset($_SESSION['id']) && isset($_SESSION['nom']))
{
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace personnel - Parents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
    <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../index.php"><img src="../img/logoRugby.png" width="80" height="50"/>Apero</a>
        <div class="navbar-nav d-inline">
            <button class="btn btn-success "><span class="fa fa-user"> <?php echo $nom; ?></span></button>
            <a href="../controlleur/deconnexion.php"><button class="btn btn-outline-dark"><span class="fa fa-sign-out">Déconnexion</span></button></a>
        </div>
    </nav>
    <div id="apero">
        <div>
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link active fa fa-user-plus">Ajouter un produit</a></li>
                <li class="nav-item"><a href="#" class="nav-link active fa fa-user-plus">Définir un parent utilisateur</a></li>
                <li class="nav-item"><a href="#" class="nav-link active fa fa-user-plus">Supprimer un parent</a></li>
                <li class="nav-item"><a href="#" class="nav-link active fa fa-user-plus">Réinitialiser la base de données</a></li>
            </ul>
        </div>
    </div>


</body>
</html>
