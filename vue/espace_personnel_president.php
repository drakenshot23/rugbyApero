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

if(!empty($_SESSION) || isset($_SESSION['id']) || isset($_SESSION['nom']) || isset($_SESSION['type']) )
{
    if ($_SESSION['type']=='parent'){
        header("Location: espace_personnel_parents.php");
    }
    else if ($_SESSION['type']=='parentUtilisateur'){
        header("Location: espace_personnel_utilisateur.php");
    }
    else if  ($_SESSION['type']=='presidentApero'){
        header("Location: espace_personnel_president.php");
    }
    header("Location: ../index.php");
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
                <li class="nav-item"><a href="#" class="nav-link fa fa-plus"> Ajouter un produit</a></li>
                <li class="nav-item"><a href="#" class="nav-link fa fa-user-plus"> Définir un parent utilisateur</a></li>
                <li class="nav-item"><a href="#" class="nav-link fa fa-minus-circle"> Supprimer un parent utilisateur</a></li>
                <li class="nav-item"><a href="#" class="nav-link fa fa-trash"> Réinitialiser la base de données</a></li>
            </ul>
        </div>
        <div id="ajouterProduit" v-if="selectedTab === 1" style="display: flex; justify-content: center;">
            <div class="form-group" style="width: 500px;" >
                <label for="nomProduit">Nom du produit</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" v-model="nomProduit" placeholder="Entre le nom du produit">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" id="prix" v-model="prix" placeholder="Entre le prix du produit en €">
                <label for="quantite">Quantité</label>
                <input type="number" class="form-control" name="quantite" id="quantite" v-model="quantite" placeholder="Entrez la quantité du produit">
                <label for="seuil">Seuil de rupture</label>
                <input type="number" class="form-control" name="seuil" id="seuil" v-model="seuil" placeholder="Entrez le seuil de rupture">
                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary" v-on:click="ajouterProduit">Ajouter Produit</button>
                </div>
            </div>
        </div>
        <div id="definirUtilisateur" v-if="selectedTab === 2">

        </div>
        <div id="supprimerUtilisateur" v-if="selectedTab === 3" style="display: flex; justify-content: center;">
            <div class="form-group" style="500px">
                <label for="mailUtilisateur">E-mail utilisateur</label>
                <input type="email" class="form-control" name="mailUtilisateur" id="mailUtilisateur" v-model="mailUtilisateur" placeholder="Entre le mail de l'utilisateur">
                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary" v-on:click="ajouterUtilisateur">Supprimer Utilisateur</button>
                </div>
            </div>
        </div>
        <div id="reinitialiser" v-if="selectedTab === 4">
            <div class="text-center" style="margin-top: 15px;">
                <button type="button" class="btn btn-danger" v-on:click="supprimerBd">Supprimer Base de données</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.js" ></script>
    <script type="text/javascript" src="../js/vue.js"></script>
    <script type="text/javascript" src="../js/app-president.js"></script>
</body>
</html>
