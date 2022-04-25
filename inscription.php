<?php
session_start();
$titre_web = "Inscription - Quiz-School";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
// $_SESSION['msgErr'] = 0;
// if($_SESSION['msgErr'] == 0){
    //     $msgErreur = "";
    // }
    // $msgErreur = "";
    // $msgErreur ="";
    require_once "./function/functions.php";
    if(isset($_POST['inscript-me'])){
        // $_SESSION['msgErr'] = 1;
        // require_once "./function/functions.php";
    echo "ehheheh";
    // $msgErreur = "ah ah";
    checkMdp();
}
var_dump($_SESSION['msgErr']);
?>
<section id="section-inscription">
<h1>INSCRIPTION</h1>
    <form action="" method="post">
        <?php echo $msgErreur?>
        <?php echo isset($msgErreur) ? $msgErreur : ""?>
        <div>
            <input type="text" placeholder="Pseudo"  name ="pseudo-inscription" value="<?=$msgErreur?>">
        </div>
        <div>
            <input type="email" name ="mail-inscription" placeholder="Adresse mail">
        </div>
        <div>
            <input type="password" name = "password-inscription" placeholder="Mot de passe">
        </div>
        <div>
            <input type="password" name="conf-pass-inscription" placeholder="Confirmation de mot de passe">
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