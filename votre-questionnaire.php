<?php
session_start();
$titre_web = "Votre questionnaire - QUIZ-SCHOOL";
if(!isset($_GET["id_quest"]) || empty($_GET["id_quest"])){
    header("Location: ./dashboard.php");
    exit;
}
    //catch id url
$idQuestionnaire = $_GET["id_quest"];

require_once "./includ-global/connectdatabase.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
require_once "./allquerry.php";

var_dump($themeCatch);
var_dump($optionCatch);
$process = 1;
unset($_SESSION['score']);
?>
<section id="display-questionnary">
    <h1>Votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <div id="box-questionnary-display">
        <h2>Theme : <?= $themeCatch[0]["theme"]?> </h2>
        <!-- php -->
        <?php foreach( $questionnaireCatch as $question) :?>
                <div class="box-boucl">
                    <div class="box-quest">
                        <p><?=$question["question"]?></p>
                        <div class="answer">
                       <?php 
                        $idquest = $question["id_quest"];
                        shuffle($optionCatch);
                       foreach($optionCatch as $result){
                            if($idquest ==  $result['quest_number']){
                                ?>
                                <span><?= $result['quest_option']; ?></span>
                                <?php
                            }
}
?>
                        </div>
                    </div>
                </div>
        <?php endforeach;?>
        <!-- php -->
        <div id="box-link-on-simul">
            <a href="./quiz-simulation.php?id_quest=<?=$themeCatch[0]['id_from_of_questionnaire']?>&nbq=<?=$process?>">Faire une simulation</a>
            <a href="./edit-questionnaire.php?id_quest=<?=$result['id_questionnaire']?>">Modifier le questionnaire</a>
        </div>
    </div>
</section>
<?php
    require_once "./includ-global/footer.php";

    // <?php foreach ($variable as $key => $value) {
    //     # code...
    // }?>
    // <?php ?>