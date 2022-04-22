<?php
$titre_web = "Modifier le questionnaire - QUIZ-SCHOOL";

require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-edit-questions">
    <h1>Modification de votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a id="link-cancel" href="./dashboard.php">Annuler</a>
    <div id="box-glob-questions">
        <form action="" method="post">
            <!-- php -->
            <div class="box-them-edit-quest">
                <label for="">Theme :</label>
                <input type="text" placeholder ="Votre thème...">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Description :</label>
                <textarea name="" id="" cols="30" rows="10" placeholder ="Aucune description..."></textarea>
            </div>
            <div id="separe-in-form-edit-questions"></div>
            <div class="box-them-edit-quest">
                <label for="">Numéro de question :</label>
                <input type="number" name="" class="nm-ber-quest" value="1" min="1" max ="12">
            </div>
            <div class="box-them-edit-quest">
                Question :
                <input type="text" placeholder ="Votre question">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Réponse 1 :</label>
                <input type="text">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Réponse 2 :</label>
                <input type="text">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Réponse 3 :</label>
                <input type="text">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Bonne Réponse : </label>
                <input type="number" class="nm-ber-quest" value="1" max="3" min="1">
            </div>
            <!-- php -->
            <div id="box-btn-sub-edit-questions">
                <input type="submit" value="Valider" name ="submit-update-question">
            </div>
        </form>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";