<?php
/**
 * Created by IntelliJ IDEA.
 * User: anthony
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

if(!empty($_SESSION['type']) && $_SESSION['type'] == 'presidentApero')
{
    header("Location: espace_personnel_president.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parent')
{
    header("Location: espace_personnel_parents.php");
}

$id = $_SESSION['id'];
$nom = $_SESSION['nom'];

?>
<!DOCTYPE html>
<html lang="fr" xmlns:v-on="http://www.w3.org/1999/xhtml">
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
        <a class="navbar-brand" href="../index.php"><img src="../img/logoRugby.png" width="100" height="70"/>Apero</a>
        <div class="navbar-nav d-inline">
            <button class="btn btn-success "><span class="fa fa-user"> <?php echo $nom; ?></span></button>
            <a href="../controlleur/deconnexion.php"><button class="btn btn-outline-dark"><span class="fa fa-sign-out">Déconnexion</span></button></a>
        </div>
    </nav>
    <div id="apero">
        <div>
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a href="#" id="ajouterCourses" class="nav-link active fa fa-plus" v-on:click="changeTab">Ajouter des courses</a></li>
                <li class="nav-item"><a href="#" id="creerGouter" class="nav-link fa fa-user-plus" v-on:click="changeTab">Créer un goûter</a></li>
            </ul>
        </div>
        <div v-if="selectedTab === 1">
            <div class="form-group" style="500px">
                <label for="nomProduit">Nom Produit</label>
                <input type="text" class="form-control">
                <label for="quantiteProduit">Quantité</label>
                <input type="number" class="form-control">
                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary" v-on:click="updateProduit">Ajouter Produit</button>
                </div>
            </div>
        </div>
        <div v-if="selectedTab === 2">
            <p>Créer un goûter</p>
        </div>
    </div>


</body>
</html>
