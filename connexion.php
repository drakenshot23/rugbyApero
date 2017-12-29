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
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="index.php">RugbyOrsay<!-- Logo rugby orsay--></a>
        <div class="navbar-nav d-inline">
            <a href="inscription.php"><button class="btn btn-outline-primary">Inscription</button></a>
        </div>
    </nav>

    <!-- Formulaire de connexion -->
    <form action="connecter.php" class="form-group container">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" placeholder="Entrez votre e-mail">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" placeholder="Entrez votre mot de passe">
        <div class="text-center" style="margin-top: 15px">
            <button class="btn btn-primary">Connexion</button>
        </div>
    </form>

</body>
</html>
