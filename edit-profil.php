<?php
session_start();
if(!isset($_SESSION['user-connect'])){
    header("Location: ./connexion.php");
}
$titre_web = "Edit Profil - QUIZ-SCHOOL";
require_once "./includ-global/connectdatabase.php";
require_once "./treat/to-connexion.php";
require_once "./function/functions.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
if(isset($_POST['sub-modif-profil'])){
    $upAvat = $_FILES['upavatar'];
    $upName = strip_tags(htmlspecialchars($_POST['up-nom']));
    $upAutName =strip_tags(htmlspecialchars( $_POST['up-prenom']));
    $upPseudo = strip_tags(htmlspecialchars($_POST['up-pseudo']));
    $upMail = strip_tags(htmlspecialchars($_POST['up-mail']));
    $upBio = strip_tags(htmlentities($_POST['the-bio']));
    $upPass = strip_tags(htmlspecialchars($_POST['pass-to-update']));
    $msgErreur = upProfil($upAvat, $upName, $upAutName, $upPseudo, $upMail, $upBio, $upPass, $db);
}
var_dump($upAvat);
var_dump(__DIR__);
var_dump($_SESSION['user-connect']);
?>
<section id="section-edit-profil">
    <h1>Modification de votre profil</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="edit-card-profil">
                <img src="<?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["profil"] == null ? "./file/avatardefault/bear-gf5600b6ed_1920.png" : $_SESSION["user-connect"]["profil"] ?>" alt="" srcset="">
                <input type="file" name="upavatar" id="">
            </div>
        <div id="box-champs-edit-pro">
            <a href="./ask-change-password"><?=!isset($_SESSION["user-connect"]["changemdp"]) ? "Changer de mot de passe" : ""?></a>
            <a href="./dashboard.php" >Annuler</a>
            <div>
            <span class="msg-to-user-form"><?= isset($msgErreur) ? $msgErreur : ""?></span>
                <input name="up-nom" type="text" placeholder ="Nom" value="<?= isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["nom"] == null ? "" : $_SESSION["user-connect"]["nom"] ?>">
            </div>
            <div>
                <input name="up-prenom" type="text" placeholder ="Prénom" value="<?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["prenom"] == null ? "" : $_SESSION["user-connect"]["nom"]?>">
            </div>
            <div>
                <input name="up-pseudo" type="text" placeholder ="Pseudo" value="<?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["pseudo"] == null ? "" : $_SESSION["user-connect"]["pseudo"] ?>">
            </div>
            <div>
                <input name="up-mail" type="Email" placeholder ="Email" value="<?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["mail"] == null ? "" : $_SESSION["user-connect"]["mail"]?>" readonly="readonly">
            </div>
            <div>
                <label for="text-bio-edit">Bio :</label>
                <textarea name="the-bio" id="text-bio-edit" cols="30" rows="10" placeholder="Ecrivez votre biographie..."><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["bio"] == null ? "" : $_SESSION["user-connect"]["bio"]?></textarea>
            </div>
            <div>
                <input type="password" name="pass-to-update" id="" placeholder ="Mot de passe">
            </div>
            <div>
                <input type="submit" value="Modifier" name="sub-modif-profil" id="btn-sub-edit-profil">
            </div>
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";