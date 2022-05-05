<?php
session_start();
require_once "./includ-global/connectdatabase.php";
$titre_web = "Inscription - Quiz-School";
require_once "./ban.php";

require_once "./treat/to-connexion.php";
require_once "./function/functions.php";
check_if_banned($db);

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
if(isset($_POST['inscript-me'])){
    $newPseudo =strip_tags(htmlspecialchars($_POST['pseudo-inscription']));
    $newMail =strip_tags(htmlspecialchars($_POST['mail-inscription']));
    $newPassWord = strip_tags(htmlspecialchars($_POST['password-inscription']));
    $newConfirmePass = strip_tags(htmlspecialchars($_POST['conf-pass-inscription']));
//    checkMdp();
   $msgErreur = inscript($newPseudo, $newMail, $newPassWord, $newConfirmePass, $db);
}
var_dump($newPassWord);
echo $newPassWord;
var_dump($newConfirmePass);
var_dump($_SESSION['user-connect']);
?>
<section id="section-inscription">
<h1>INSCRIPTION</h1>
        <?php
        // if(isset($msgErreur)){echo $msgErreur;var_dum($msgErreur);}
        ?>
    <form action="" method="post">
        <span class="msg-to-user-form"><?= isset($msgErreur) ? $msgErreur : ""?></span>
        <div>
            <input type="text" placeholder="Pseudo"  name ="pseudo-inscription" value="<?=isset($newPseudo) ? $newPseudo : ""?>" autocomplete ="off">
        </div>
        <div>
            <input type="email" name ="mail-inscription" placeholder="Adresse mail" value="<?=isset($newMail) ? $newMail : ""?>" autocomplete ="off">
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