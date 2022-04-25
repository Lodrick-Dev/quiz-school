<?php
$titre_web = "Connexion - Quiz-School";
require_once "./includ-global/connectdatabase.php";
require_once "./function/functions.php";
require_once "./treat/to-connexion.php";
// if(isset($_POST['connect-me'])){

// }
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-connect">
    <h1>CONNEXION</h1>
    <form action="" method="post">
        <div>
            <input type="email" placeholder="Adresse mail">
        </div>
        <div>
            <input type="password" placeholder="Mot de passe">
        </div>
        <div id="btn-sub-connect">
            <input type="submit" value="Connexion" name="connect-me">
        </div>
        <div id="box-link-to-sub-on-connect-page">
            <a href="./inscription.php">Pas de compte ? S'inscrire</a>
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";