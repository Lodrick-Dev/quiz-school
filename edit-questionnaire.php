<?php
session_start();
$idQuestionnaire = $_GET["id_quest"];
$titre_web = "Modifier le questionnaire - QUIZ-SCHOOL";
require_once "./includ-global/connectdatabase.php";

require_once "./function/functions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
require_once "./allquerry.php";
var_dump($questionnaireCatch);
var_dump($themeCatch);
var_dump($optionCatch);
?>
<section id="section-edit-questions">
    <h1>Modification de votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a id="link-cancel" href="./dashboard.php">Annuler</a>
    <div id="box-glob-questions">
        <form action="" method="post">
            <!-- php -->
            <div class="box-them-edit-quest">
                <label for="">Numero de questionnaire :</label>
                <input type="number" value="<?=$themeCatch[0]["id_from_of_questionnaire"]?>">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Theme :</label>
                <input type="text" placeholder ="Votre thème..." value="<?=$themeCatch[0]["theme"]?>">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Description :</label>
                <textarea name="" id="" cols="30" rows="10" placeholder ="Aucune description..."><?=$themeCatch[0]["description"]?></textarea>
            </div>
            <div class="separe-in-form-edit-questions"></div>
            <!--php-->
            <?php foreach( $questionnaireCatch as $question) :?>
            <div class="box-them-edit-quest">
                <label for="">Numéro de question :</label>
                <input type="number" name="" class="nm-ber-quest" value="<?=$question['id_quest']?>" min="1" max ="12">
            </div>
            <div class="box-them-edit-quest">
                Question :
                <input type="text" placeholder ="Votre question" value="<?=$question['question']?>">
            </div>
            <!-- php -->
            <?php $nb = $question["id_quest"];
            foreach($optionCatch as $catch){
                if($nb == $catch["quest_number"]){
                    ?>
                    <div class="box-them-edit-quest">
                        <label for="">Réponse <?=$catch["num_response"]?> :</label>
                        <input type="text" value="<?=$catch["quest_option"]?>">
                    </div>
                    <?php
                }
            }?>
            <div class="separe-in-form-edit-questions"></div>
            <?php endforeach;?>
            <!-- php -->
            <div id="box-btn-sub-edit-questions">
                <input type="submit" value="Valider" name ="submit-update-question">
            </div>
        </form>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";