<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("NAMEBASE", "quizschool");

$dsn = "mysql:dbname=".NAMEBASE.";host=".DBHOST;

try{
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Erreur : ". $e->getMessage());
};