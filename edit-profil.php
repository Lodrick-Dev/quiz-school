<?php
session_start();
$titre_web = "Edit Profil - QUIZ-SCHOOL";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
var_dump($_SESSION['user-connect']);
?>
<section id="section-edit-profil">
    <h1>Modification de votre profil</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <form action="">
            <div class="edit-card-profil">
                <img src="./file/avatardefault/bear-gf5600b6ed_1920.png" alt="" srcset="">
                <input type="file" name="" id="">
            </div>
        <div id="box-champs-edit-pro">
            <a href="./changemdp.php">Changer de mot de passe</a>
            <div>
                <input type="text" placeholder ="Nom">
            </div>
            <div>
                <input type="text" placeholder ="Prénom">
            </div>
            <div>
                <input type="text" placeholder ="Pseudo">
            </div>
            <div>
                <input type="Email" placeholder ="Email">
            </div>
            <div>
                <input type="password" placeholder ="Ancien mot de passe">
            </div>
            <div>
                <input type="password" placeholder ="Nouveau mot de passe">
            </div>
            <div>
                <input type="password" placeholder ="Confirmation du nouveau mot de passe">
            </div>
            <div>
                <label for="text-bio-edit">Bio :</label>
                <textarea name="" id="text-bio-edit" cols="30" rows="10" placeholder="Ecrivez votre biographie..."></textarea>
            </div>
            <div>
                <input type="password" name="" id="" placeholder ="Mot de passe">
            </div>
            <div>
                <input type="submit" value="Modifier" id="btn-sub-edit-profil">
            </div>
        </div>
    </form>
</section>
<?php
    require_once "./includ-global/footer.php";