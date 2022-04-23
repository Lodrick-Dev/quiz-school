<?php
$titre_web = "Création - QUIZ-SCHOOL";
require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-creat-quiz">
<h1>Création de votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a id="link-cancel" href="./dashboard.php">Annuler</a>
    <div id="box-glob-creat-questions">
        <div id="box-to-form-select-numb">
            <form action="" method="post">
                <label for="">Combien de question ?</label>
                <select name="" id="">
                    <option value="null">--Null--</option>
                    <option value="trois">--3--</option>
                    <option value="six">--6--</option>
                    <option value="neuf">--9--</option>
                    <option value="douze">--12--</option>
                </select>
                <input type="submit" value="Commencer" name="choose-numb-quest-add">
            </form>
        </div>
        <form action="" method="post">
            <div class="box-creat-them-quest">
                <label for="">Theme :</label>
                <input type="text" placeholder ="Votre thème...">
            </div>
            <div class="box-creat-descrip-quest">
                <label for="">Description :</label>
                <textarea name="" id="" cols="30" rows="10" placeholder ="Aucune description..."></textarea>
            </div>
            <div id="separe-in-form-creat-questions"></div>
            <!-- php boucl -->
            <div class="box-creat-quest">
                <label for="">Numéro de question :</label>
                <input type="number" name="" class="nm-ber-quest" value="1" min="1" max ="12">
            </div>
            <div class="box-creat-quest">
                Question :
                <input type="text" placeholder ="Votre question">
            </div>
            <div class="box-creat-quest">
                <label for="">Réponse 1 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest">
                <label for="">Réponse 2 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest">
                <label for="">Réponse 3 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest">
                <label for="">Bonne Réponse : </label>
                <input type="number" class="nm-ber-quest" value="1" max="3" min="1">
            </div>
            <!-- php -->
            <div id="box-btn-sub-creat-questions">
                <input type="submit" value="Envoyer" name ="submit-creat-question">
            </div>
        </form>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";