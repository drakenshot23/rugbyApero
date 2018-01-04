<?php
/**
 * Created by IntelliJ IDEA.
 * User: Robert
 * Date: 04/01/2018
 * Time: 20:38
 */

session_start();

$_SESSION = array();
session_destroy();

header("Location: ../index.php");

?>