<?php
session_start();
if(!isset($_SESSION["user-connect"])){
    header("Location: ./connexion.php");
    exit;
}

//suppprime la session
session_destroy($_SESSION["user-connect"]);
// session_destroy();
header("Location: ./connexion.php");