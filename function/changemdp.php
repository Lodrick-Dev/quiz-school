<?php
session_start();
if(!isset($_SESSION['user-connect'])){
    header("Location: ./connexion.php");
}else{
    if(!isset($_SESSION["user-connect"]['changemdp'])){
        //ajouté donné dans la session
        $_SESSION["user-connect"]['changemdp'] = 1;
        header("Location: ".@$_SERVER['HTTP_REFERER']."");
    }else{
        //supprimé donnée dans la session
        unset($_SESSION["user-connect"]['changemdp']);
        header("Location: ".@$_SERVER['HTTP_REFERER']."");
    }
    header("Location: ".@$_SERVER['HTTP_REFERER']."");
}