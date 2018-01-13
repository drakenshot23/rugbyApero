<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 27/12/2017
 * Time: 21:55
 */

session_start();

$id = null;
$nom = null;

if(!empty($_SESSION['type']) && $_SESSION['type'] == 'presidentApero')
{
    header("Location: vue/espace_personnel_president.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parent')
{
    header("Location: vue/espace_personnel_parents.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parentUtilisateur')
{
    header("Location: vue/espace_personnel_utilisateur.php");
}

if(!empty($_SESSION['id']) && !empty($_SESSION['nom']))
{
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Apero Orsay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
            <a class="navbar-brand logo-centre" href="index.php"><img src="img/logoRugby.png" width="80" height="50"/>Apero</a>
            <div class="navbar-nav d-inline">
                <a href="vue/formulaire_inscription.php"><button class="btn btn-outline-primary">Inscription</button></a>
                <a href="vue/formulaire_connexion.php"><button class="btn btn-outline-success">Connexion</button></a>
            </div>
        </nav>
    </body>
    <style>
        @media screen and(max-width: 1150px)
        {
            .logo-centre
            {
                text-align: center;
            }
        }
    </style>
</html>

