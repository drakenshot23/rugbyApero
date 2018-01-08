<?php
/**
 * Created by IntelliJ IDEA.
 * User: Antho
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