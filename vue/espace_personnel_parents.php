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

    <div id="app">
        <div class="container" id="enfants">
            <h1 style="text-align: center;">Enfants</h1>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">Lucas <span class="badge badge-primary">Solde : {{ price }}$</span></li>
            </ul>
        </div>

        <div id="lol">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link active">Inscrire Enfant</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Ajouter Argent</a></li>
            </ul>
            <div class="container" id="inscriptionEnfant">
                <form action="#" method="POST" class="form-group container" id="inscriptionEnfant">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prenom">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" id="age" placeholder="Entrez votre age">
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control" name="categorie" id="categorie" placeholder="Entrez votre categorie">
                    <div class="text-center" style="margin-top: 15px;">
                        <button type="submit" class="btn btn-primary">Inscription</button>
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
