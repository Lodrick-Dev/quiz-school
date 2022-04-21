<?php
$titre_web = "QUIZ-SCHOLL - Accueil";
require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";
if(isset($_POST['connect-me'])){

}
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
        <div>
            <input type="submit" value="Connexion" name="connect-me">
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";