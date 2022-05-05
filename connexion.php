<?php
session_start();
$titre_web = "Connexion - Quiz-School";
if(isset($_SESSION['user-connect'])){
    header("Location: ./dashboard.php");
}
require_once "./includ-global/connectdatabase.php";
require_once "./function/functions.php";
require_once "./treat/to-connexion.php";
require_once "./ban.php";
// if(isset($_POST['connect-me'])){

// }
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
check_if_banned($db);
if(isset($_POST['connect-me'])){
    $mailConnect =strip_tags(htmlspecialchars($_POST['mail-connect']));
    $passConnect =strip_tags(htmlspecialchars($_POST['pass-connect']));
//    checkMdp();
   $msgErreur = connect($mailConnect, $passConnect, $db);
}
var_dump($_SESSION["user-connect"]);

$mok = "manual/fr/function.urlencode.php";
sha1($mok);
$linkactu = $_GET["connexion"];
?>
<section id="section-connect">
    <h1>CONNEXION</h1>
    <form action="" method="post">
    <span class="msg-to-user-form"><?= isset($msgErreur) ? $msgErreur : ""?></span>
        <div>
            <input type="email" placeholder="Adresse mail" name="mail-connect" value="<?=isset($mailConnect) ? $mailConnect : "" ?>">
        </div>
        <div>
            <input type="password" placeholder="Mot de passe" name="pass-connect">
        </div>
        <div id="btn-sub-connect">
            <input type="submit" value="Connexion" name="connect-me">
        </div>
        <div id="box-link-to-sub-on-connect-page">
            <a href="./inscription.php">Pas de compte ? S'inscrire</a>
            <a href="./ask-change-password.php">Mot de passe oublié ?</a>
            <a href="https://wa.me/0768107922/?text=Hello badgyal <?=$linkactu?>" target="_blank">Mot de passe oublié ?</a>
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";