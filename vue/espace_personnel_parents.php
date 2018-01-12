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

if(!empty($_SESSION) || isset($_SESSION['id']) || isset($_SESSION['nom']) || isset($_SESSION['type']) )
{
    if ($_SESSION['type']=='parent'){
        header("Location: espace_personnel_parents.php");
    }
    else if ($_SESSION['type']=='parentUtilisateur'){
        header("Location: espace_utilisateur.php");
    }
    else if  ($_SESSION['type']=='presidentApero'){
        header("Location: espace_president.php");
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
        <div class="float-left" style="width: 250px; margin-right: 20px;">
            <h1 style="text-align: center;">Enfants</h1>
            <ul class="list-group" v-for="enfant in listeEnfants">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-on:click="selectionnerEnfant">{{ enfant.prenom }} <span class="badge badge-primary">Solde : {{ enfant.solde }}€</span></li>
            </ul>
        </div>

        <div>
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a href="#" id="ajoutArgent" class="nav-link fa fa-plus" v-on:click="changeTab"> Ajouter Argent</a></li>
                <li class="nav-item"><a href="#" id="inscriptionEnfant" class="nav-link fa fa-user-plus" v-on:click="changeTab"> Inscrire Enfant</a></li>
            </ul>
            <div v-if="selectedTab === 1" style="display: flex; justify-content: center;">
                <form class="form-group" style="width: 500px;">
                    <label for="montantEnfant">{{enfantSelectionne}}</label>
                    <input type="number" class="form-control" id="montantEnfant" v-model="montant" placeholder="Montant à ajouter">
                    <div class="text-center" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" v-on:click="">Ajouter de l'argent</button>
                    </div>
                </form>
            </div>
            <div v-if="selectedTab === 2" style="display: flex; justify-content: center;">
                <form  class="form-group" style="width: 500px;">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" v-model="nouvelEnfant.nom" placeholder="Entrez votre nom">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" v-model="nouvelEnfant.prenom" placeholder="Entrez votre prenom">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" id="age" v-model="nouvelEnfant.age" placeholder="Entrez votre âge">
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control" name="categorie" id="categorie" v-model="nouvelEnfant.categorie" placeholder="Entrez votre categorie">
                    <label for="telParent">Numero de téléphone</label>
                    <input type="tel" class="form-control" name="telParent" id="telParent" v-model="nouvelEnfant.telParent" placeholder="Numero de téléphone">
                    <div class="text-center" style="margin-top: 15px;">
                        <button type="button" class="btn btn-primary" v-on:click="inscrireEnfant">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.js" ></script>
    <script type="text/javascript" src="../js/vue.js"></script>
    <script type="text/javascript" src="../js/app-parents.js"></script>
</body>
</html>
