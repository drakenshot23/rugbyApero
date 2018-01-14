<?php

session_start();

if(empty($_SESSION))
{
    header("Location: ../index.php");
}

$id = null;
$nom = null;

if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parent')
{
    header("Location: espace_personnel_parents.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parentUtilisateur')
{
    header("Location: espace_personnel_utilisateur.php");
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
                <li class="nav-item"><a href="#" id="ajouterProduit" class="nav-link fa fa-plus" v-on:click="changeTab"> Ajouter un produit</a></li>
                <li class="nav-item"><a href="#" id="listeProduits" class="nav-link fa fa-list" v-on:click="changeTab"> Liste des produits</a></li>
                <li class="nav-item"><a href="#" id="definirUtilisateur" class="nav-link fa fa-user-plus" v-on:click="changeTab"> Définir un parent utilisateur</a></li>
                <li class="nav-item"><a href="#" id="supprimerUtilisateur" class="nav-link fa fa-minus-circle" v-on:click="changeTab"> Supprimer un parent utilisateur</a></li>
                <li class="nav-item"><a href="#" id="reinitialiser" class="nav-link fa fa-trash" v-on:click="changeTab"> Réinitialiser la base de données</a></li>

            </ul>
        </div>
        <div  v-if="selectedTab === 1" style="display: flex; justify-content: center;">
            <div class="form-group" style="width: 500px;" >
                <label for="nomProduit">Nom du produit</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" placeholder="Entre le nom du produit">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" id="prix" placeholder="Entre le prix du produit en €">
                <label for="quantite">Quantité</label>
                <input type="number" class="form-control" name="quantite" id="quantite" placeholder="Entrez la quantité du produit">
                <label for="seuil">Seuil de rupture</label>
                <input type="number" class="form-control" name="seuil" id="seuil"  placeholder="Entrez le seuil de rupture">
                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary" >Ajouter Produit</button>
                </div>
            </div>
        </div>
        <div v-if="selectedTab === 2" style="display: flex; justify-content: center;">
            <div class="form-group" style="width: 500px;">
                <h1>Produits</h1>
            </div>
        </div>
        <div v-if="selectedTab === 3" style="display: flex; justify-content: center;">
            <div class="form-group" style="width: 500px;">
                <label for="nomUtilisateur">Nom</label>
                <input type="text" class="form-control" name="nomUtilisateur" id="nomUtilisateur" placeholder="Nom du parent utilisateur">
                <label for="prenomUtilisateur">Prenom</label>
                <input type="text" class="form-control" name="prenomUtilisateur" id="prenomUtilisateur" placeholder="Prenom du parent utilisateur">
                <label for="mailNouvelUtilisateur">E-mail utilisateur</label>
                <input type="email" class="form-control" name="mailNouvelUtilisateur" id="mailNouvelUtilisateur" placeholder="E-mail de l'utilisateur">

                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary" >Ajouter nouvel utilisateur</button>
                </div>
            </div>
        </div>
        <div v-if="selectedTab === 4" style="display: flex; justify-content: center;">
            <div class="form-group" style="width: 500px;">
                <label for="mailUtilisateur">E-mail utilisateur</label>
                <input type="email" class="form-control" name="mailUtilisateur" id="mailUtilisateur" placeholder="Entre le mail de l'utilisateur">
                <div class="text-center" style="margin-top: 15px;">
                    <button type="button" class="btn btn-danger" >Supprimer l'utilisateur</button>
                </div>
            </div>
        </div>
        <div v-if="selectedTab === 5" style="display: flex; justify-content: center;">
            <div class="text-center" style="margin-top: 15px;">
                <button type="button" class="btn btn-danger" >Reinitialiser la base de données</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.js" ></script>
    <script type="text/javascript" src="../js/vue.js"></script>
    <script type="text/javascript" src="../js/app-president.js"></script>
</body>
</html>
