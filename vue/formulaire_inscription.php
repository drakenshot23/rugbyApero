<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 28/12/2017
 * Time: 23:28
 */

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Apero Orsay</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
    </head>
    <body>
        <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="../index.php">RugbyOrsay<!-- Logo rugby orsay--></a>
            <div class="navbar-nav d-inline">
                <a href="formulaire_connexion.php"><button class="btn btn-outline-success">Connexion</button></a>
            </div>
        </nav>

        <!-- Formulaire d'inscription -->
        <form action="../controlleur/inscription.php" method="POST" class="form-group container">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prenom">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="Entrez votre e-mail">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" placeholder="Entrez votre mot de passe">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" placeholder="Entrez votre ville">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
            <div class="text-center" style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary">Inscrire</button>
            </div>
        </form>
        <?php
            if(isset($_COOKIE["erreur"])) {
                $erreur = $_COOKIE["erreur"];
                echo '<div class="alert alert-danger"><strong>Erreur!</strong>' . $erreur . '</div>';
            } else
            {
                echo 'not cookie';
            }
        ?>
    </body>
</html>

