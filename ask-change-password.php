<?php
session_start();
$titre_web = "Demande changement - QUIZ-SCHOOL";
    session_destroy();

require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
// unset($_SESSION["user-connect"]);
?>
<section id="section-init-pass-word-just-mail">
    <h1>Initialisation du mot de passe</h1>
    <form action="" method="post">
            <div>
                <input type="email" placeholder ="Entrez votre adresse mail">
            </div>
            <input type="submit" value="Initialiser">
    </form>
</section>