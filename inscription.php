<?php
$titre_web = "Inscription - Quiz-School";
require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-inscription">
<h1>INSCRIPTION</h1>
    <form action="" method="post">
        <div>
            <input type="text" placeholder="Pseudo">
        </div>
        <div>
            <input type="email" placeholder="Adresse mail">
        </div>
        <div>
            <input type="password" placeholder="Mot de passe">
        </div>
        <div>
            <input type="password" placeholder="Confirmation de mot de passe">
        </div>
        <div id="btn-sub-inscript">
            <input type="submit" value="S'inscrire" name="inscript-me">
        </div>
        <div id="box-link-to-sub-on-inscript-page">
            <a href="./connexion.php">Déjà un compte ? Connexion</a>
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";