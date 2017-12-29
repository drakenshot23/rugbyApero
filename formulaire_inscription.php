<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 29/12/2017
 * Time: 15:24
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <tite> Inscritpion Parent </tite>
</head>

<body>
<form method="post" action="inscription.php">
    <p>Nom : <input type="text" name="nomP">       Prénom : <input type="text" name="prenomP"></p>
    <p>Mail : <input type="text" name="mailP"></p>
    <p>Mot de passe : <input type="text" name="mdp"></p>
    <p>Confirmer le mot de passe : <input type="text" name="mdp2"></p>
    <p>Ville : <input type="text" name="ville"></p>
    <p>CP : <input type="text" name="CP"></p>
    <input type="submit" value="Valider">
</form>
</body>
</html>
