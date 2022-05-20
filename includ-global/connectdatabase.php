<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("NAMEBASE", "quizschool");

if(isset($_GET["token"]) && $_GET["token"] != $_SESSION["token"]){
    die("Jeton de sécurité expiré...");
}

$dsn = "mysql:dbname=".NAMEBASE.";host=".DBHOST;

try{
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Erreur : ". $e->getMessage());
};