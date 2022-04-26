<?php
session_start();
//cette page est a envoyé au user quand il font leur demande d'init de mot de passe
if(!isset($_SESSION['user-connect'])){
    header("Location: ./connexion.php");
}
$titre_web = "Change mdp - QUIZ-SCHOOL";

require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-change-pass-word-mail">
    <h1>Changer de mot de passe</h1>
    <form action="" method="post">
            <div>
                <input type="password" placeholder ="Nouveau mot de passe">
            </div>
            <div>
                <input type="password" placeholder ="Confirmation du nouveau mot de passe">
            </div>
            <input type="submit" value="Allons-y">
    </form>
</section>