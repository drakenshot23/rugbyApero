<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 29/12/2017
 * Time: 13:00
 */

setcookie("erreur", "Votre inscription à echoué!", time() + 5);

header("Location: ../vue/formulaire_inscription.php")

?>