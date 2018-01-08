<?php
    session_start();
    if(!empty($_SESSION) || isset($_SESSION['id']) || isset($_SESSION['nom'] || isset($_SESSION['type'])))
    {
        if ($_SESSION['type']=='parent'){
            header("Location: espace_personnel_parents.php");
        }
        else if ($_SESSION['type']=='parenUtilisateur'){
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
    <title>Apero Orsay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <nav class="navbar navbar-light bg-faded" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../index.php"><img src="../img/logoRugby.png" width="75" height="50"/>Apero</a>
        <div class="navbar-nav d-inline">
            <a href="formulaire_inscription.php"><button class="btn btn-outline-primary">Inscription</button></a>
        </div>
    </nav>

    <!-- Formulaire de connexion -->
    <form action="../controlleur/connexion.php" method="POST" class="form-group container">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez votre mot de passe">
        <div class="text-center" style="margin-top: 15px">
            <button class="btn btn-primary">Se connecter</button>
        </div>
    </form>
    <?php
        if(isset($_GET['err']) && $_GET['err'] == 'errInscrit')
        {
            echo "<div class='container-fluid'><p class='alert alert-danger' style='text-align: center'>Mauvais identifiant ou mot de passe!</p></div>";
        }
    ?>
</body>
</html>
