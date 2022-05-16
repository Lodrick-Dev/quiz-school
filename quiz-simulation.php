<?php
session_start();
require_once "./includ-global/head.php";
$titre_web = "Simulation - QUIZ-SCHOOL";
if(!isset($_GET["id_quest"]) || empty($_GET["id_quest"])){
    header("Location: ./dashboard.php");
    exit;
}
$idQuestionnaire = $_GET["id_quest"];
require_once "./includ-global/connectdatabase.php";
require_once "./function/functions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/nav.php";
require_once "./allquerry.php";

$_SESSION["score"]=0;

$process = $_GET["nbq"];
$pro = 0;

if(isset($_POST["btn-simulation"])){
    $score = 0;
    $choiceUser = strip_tags(htmlspecialchars($_POST["choice_user"]));
    simulQuiz($choiceUser, $process, $idQuestionnaire, $optionCatch, $score, $db);
}
echo $process. "<br>";
echo $_SESSION['score'];
echo count($questionnaireCatch);
var_dump($questionnaireCatch);

$sqlQuerry = "SELECT * FROM `choix_question` WHERE id_questionnaire = :qnb AND quest_number = :nbr AND correct = 1";
   $sqlPrepare = $db->prepare($sqlQuerry);
   $sqlPrepare->bindValue(":qnb", $idQuestionnaire, PDO::PARAM_INT);
   $sqlPrepare->bindValue(":nbr", $process, PDO::PARAM_INT);
   if($sqlPrepare->execute()){
      $correctChoice = $sqlPrepare->fetch();
      var_dump($correctChoice);
      echo $correctChoice["quest_option"];
    }
?>
<section id="section-quiz-simulation">
    <h1>Simulation</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a href="./dashboard.php" class="stop-cancel">Arretez la simulation</a>
    <div id="box-simulation-live">
        <h2>Theme : <span><?= $themeCatch[0]["theme"]?></span></h2>
        <?php foreach($questionnaireCatch as $quest):?>
        <form action="" method="post" class="<?= $process == $quest["id_quest"] ? "visi" : "invi" ?>">
            <h2><?= $quest["question"] ?></h2>
            <div id="box-glob-of-div-n-input">
                <?php
                $idQuest = $quest["id_quest"];
                shuffle($optionCatch);
                foreach($optionCatch as $opt){
                    if($idQuest == $opt["quest_number"]){
                        ?>
                        <div>
                            <input type="radio" name="choice_user" id="<?= $opt["quest_option"]?>" value="<?= $opt["quest_option"]?>">
                            <label for="<?= $opt["quest_option"]?>"><?=$opt["quest_option"]?></label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div id="btn-to-simul-val">
                <input type="submit" value="Valider" name="btn-simulation">
            </div>
        </form>
        <?php endforeach;?>
    </div>
</section>
<?php 
require_once "./includ-global/footer.php";