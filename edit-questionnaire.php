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

if(isset($_POST['submit-update-question'])){
    $numberOfQuestionnaire = strip_tags(htmlspecialchars($_POST['nm-quest']));
    $themeQuest = strip_tags(htmlspecialchars($_POST['letheme']));
    $descripQuest = strip_tags(htmlspecialchars($_POST['ladescript']));
    //change value now 0
    echo $id1Quest = strip_tags(htmlspecialchars($_POST["idenQuest1"]));
    echo $quest1 = strip_tags(htmlspecialchars($_POST["laquestion1"]));
    echo $option1To1 = strip_tags(htmlspecialchars($_POST["option1of1"]));
    echo $option2To1 = strip_tags(htmlspecialchars($_POST["option1of2"]));
    echo $option3To1 = strip_tags(htmlspecialchars($_POST["option1of3"]));
    echo $optionGoodTo1 = strip_tags(htmlspecialchars($_POST["goodR1of3"]));
    //change value now 1
    echo $id2Quest = strip_tags(htmlspecialchars($_POST["idenQuest2"]));
    echo $quest2 = strip_tags(htmlspecialchars($_POST["laquestion2"]));
    echo $option1To2 = strip_tags(htmlspecialchars($_POST["option2of1"]));
    echo $option2To2  = strip_tags(htmlspecialchars($_POST["option2of2"]));
    echo $option3To2 = strip_tags(htmlspecialchars($_POST["option2of3"]));
    echo $optionGoodTo2 = strip_tags(htmlspecialchars($_POST["goodR2of3"]));
    //change value now 2
    echo $id3Quest = strip_tags(htmlspecialchars($_POST["idenQuest3"]));
    echo $quest3 = strip_tags(htmlspecialchars($_POST["laquestion3"]));
    echo $option1To3 = strip_tags(htmlspecialchars($_POST["option3of1"]));
    echo $option2To3 = strip_tags(htmlspecialchars($_POST["option3of2"]));
    echo $option3To3 = strip_tags(htmlspecialchars($_POST["option3of3"]));
    echo $optionGoodTo3 = strip_tags(htmlspecialchars($_POST["goodR2of3"]));

    //function call
    $msgErreur = updateQuestion($numberOfQuestionnaire ,$themeQuest,$descripQuest,$id1Quest,$quest1,$option1To1,$option2To1,$option3To1,$optionGoodTo1, $id2Quest,$quest2,$option1To2,$option2To2,$option3To2,$optionGoodTo2, $id3Quest,$quest3,$option1To3,$option2To3,$option3To3,$optionGoodTo3,$db);
    

}

var_dump($catchAll);
?>
<section id="section-edit-questions">
    <h1>Modification de votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <?php
    echo " <br> Numéro de questionnaire existant : ";
    foreach ($catchAll as $index) {
        echo " - ". $index['id_from_of_questionnaire'];
    }
    ?>
    <a id="link-cancel" href="./dashboard.php">Annuler</a>
    <div id="box-glob-questions">
    <span class="msg-to-user-form"><?= isset($msgErreur) ? $msgErreur : ""?></span>
        <form action="" method="post">
            <div class="box-them-edit-quest">
                <label for="">Numero de questionnaire :</label>
                <input type="number" value="<?=$themeCatch[0]["id_from_of_questionnaire"]?>" name ="nm-quest">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Theme :</label>
                <input type="text" placeholder ="Votre thème..." value="<?=$themeCatch[0]["theme"]?>" name="letheme">
            </div>
            <div class="box-them-edit-quest">
                <label for="">Description :</label>
                <textarea name="ladescript" id="" cols="30" rows="10" placeholder ="Aucune description..."><?=$themeCatch[0]["description"]?></textarea>
            </div>
            <div class="separe-in-form-edit-questions"></div>
            <?php foreach( $questionnaireCatch as $question) :?>
            <div class="box-them-edit-quest">
                <label for="">Numéro de question :</label>
                <input type="number" name="idenQuest<?=$question['id_quest']?>" class="nm-ber-quest" value="<?=$question['id_quest']?>" min="1" max ="12">
            </div>
            <div class="box-them-edit-quest">
                Question <?=$question['id_quest']?>:
                <input type="text" name="laquestion<?=$question['id_quest']?>" placeholder ="Votre question" value="<?=$question['question']?>">
            </div>
            <?php
            //***pour identifé les options lieé alors question
            $nb = $question["id_quest"];
            foreach($optionCatch as $catch){
                if($nb == $catch["quest_number"]){
                    ?>
                    <div class="box-them-edit-quest">
                        <label for="">Réponse <?=$catch["num_response"]?> :</label>
                        <input type="text" name="option<?=$question['id_quest']?>of<?=$catch["num_response"]?>" value="<?=$catch["quest_option"]?>">
                    </div>
                    <?php
                }
            }?>
            <?php
            //*** pour identifié la bonne réponse
            $nb = $question["id_quest"];
            foreach($optionCatch as $good){
                if($nb == $good["quest_number"] && $good["correct"] === '1'){
                        ?>
                        <div class="box-them-edit-quest">
                           <label for="">Bonne réponse :</label>
                           <input type="number" name="goodR<?=$question['id_quest']?>of<?=$catch["num_response"]?>" value="<?=$good["num_response"]?>">
                       </div>
                        <?php
                   }
            } //*** ?>

            <div class="separe-in-form-edit-questions"></div>
            <?php endforeach;?>
            <div id="box-btn-sub-edit-questions">
                <input type="submit" value="Valider" name ="submit-update-question">
            </div>
        </form>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";