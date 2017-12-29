<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 29/12/2017
 * Time: 15:26
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription Enfant</title>

</head>
<body>
<form method="post" action="vue/inscription_enfant.php">
    <p>Nom : <input type="text" name="nomE">       Prénom : <input type="text" name="prenomE"></p>
    <p>Age : <input type="text" name="ageE"></p>
    <p>Téléphone parent : <input type="text" name="telP"></p>
    <p>Mail parent : <input type="text" name="mailP"></p>
    <p> Catégorie : </p>
    <SELECT name="CatE" size="1">
        <OPTION>Minime
        <OPTION>Benjamin
        <OPTION>Junior 1
        <OPTION>Junior 2
    </SELECT>
    <input type="submit" value="Valider">

</form>
</body>
</html>
