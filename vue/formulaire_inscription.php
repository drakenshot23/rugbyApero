<?php
session_start();
if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parentUtilisateur')
{
    header("Location: espace_personnel_utilisateur.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'presidentApero')
{
    header("Location: espace_personnel_president.php");
} else if(!empty($_SESSION['type']) && $_SESSION['type'] == 'parent')
{
    header("Location: espace_personnel_parents.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Apero Orsay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
    </head>
    <body>
        <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="../index.php"><img src="../img/logoRugby.png" width="80" height="50"/>Apero</a>
            <div class="navbar-nav d-inline">
                <a href="formulaire_connexion.php"><button class="btn btn-outline-success">Connexion</button></a>
            </div>
        </nav>

        <!-- Formulaire d'inscription -->
        <form action="../controlleur/inscription.php" method="POST" class="form-group container">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
            <?php if(isset($_GET['err']) && $_GET["err"] == "errNom") echo '<span class="alert-danger">Veuillez rentrer seulement des lettres!</span><br>';?>
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom">
            <?php if(isset($_GET['err']) && $_GET["err"] == "errPrenom") echo '<span class="alert-danger">Veuillez rentrer seulement des lettres!</span><br>';?>
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail">
            <?php if(isset($_GET['err']) && $_GET["err"] == "errEmail") echo '<span class="alert-danger">E-mail incorrect</span><br>';?>
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez votre mot de passe">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrez votre ville">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse">
            <label for="cp">Code postal</label>
            <input type="text" class="form-control" id="cp" name="cp" placeholder="Entrez votre code postal">
            <div class="text-center" style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
        <?php
            if(isset($_GET['err']) && $_GET['err'] == 'noError')
            {
                echo "<div class='container-fluid'><p class='alert alert-success' style='text-align: center'>Votre inscription à réussie vous pouvez vous connecter!</p></div>";
            } else if(isset($_GET['err']) && $_GET['err'] == 'errExist')
            {
                echo "<div class='container-fluid'><p class='alert alert-danger' style='text-align: center'>Inscription échouée vous avez déjà un compte!</p></div>";
            }
        ?>
    </body>
</html>