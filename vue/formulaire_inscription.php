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
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez votre mot de passe">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrez votre ville">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse">
            <label for="cp">Code postal</label>
            <input type="text" class="form-control" id="cp" name="cp" placeholder="Entrez votre code postal">
            <div class="text-center" style="margin-top: 15px;">
                <button type="submit" class="btn btn-primary">Inscrire</button>
            </div>
        </form>

    </body>
</html>

