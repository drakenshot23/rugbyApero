<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
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
        <div class="float-left" style="width: 250px; margin-right: 20px;">
            <h1 style="text-align: center;">Enfants</h1>
            <ul class="list-group" v-for="enfant in listeEnfants">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-on:click="selectionnerEnfant">{{ enfant.nom }} <span class="badge badge-primary">Solde : {{ enfant.solde }}€</span></li>
            </ul>
        </div>

        <div id="">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link fa fa-plus" v-on:click="afficher"> Ajouter Argent</a></li>
                <li class="nav-item"><a href="#" class="nav-link active fa fa-user-plus" v-on:click="afficher"> Inscrire Enfant</a></li>
            </ul>
            <div id="ajoutArgent" v-if="afficherAjouterArgent" style="display: flex; justify-content: center;">
                <form class="form-group" id="ajoutArgent" style="width: 500px;">
                    <label for="montantEnfant">{{enfantSelectionne}}</label>
                    <input type="number" class="form-control" id="montantEnfant" placeholder="Montant à ajouter">
                    <div class="text-center" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" v-on:click="">Ajouter de l'argent</button>
                    </div>
                </form>
            </div>
            <div id="inscriptionEnfant" style="display: flex; justify-content: center;" v-else>
                <form  class="form-group" id="inscriptionEnfant" style="width: 500px;">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prenom">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" id="age" placeholder="Entrez votre âge">
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control" name="categorie" id="categorie" placeholder="Entrez votre categorie">
                    <div class="text-center" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" v-on:click="inscrireEnfant">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.js" ></script>
    <script type="text/javascript" src="../js/vue.js"></script>
    <script type="text/javascript" src="../js/app.js"></script>
</body>
</html>
