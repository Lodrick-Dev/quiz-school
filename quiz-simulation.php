<?php
session_start();
// session_destroy();
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
// unset($_SESSION["score"]);
// $_SESSION['score'] = 0;
// $_SESSION['score']++;
// $_SESSION['score']++;
if(!isset($_SESSION["score"])){
    $_SESSION["score"] = 0;
}

$process = $_GET["nbq"];
$pro = 0;

if(isset($_POST["btn-simulation"])){
    if(isset($_POST["choice_user"]) && !empty($_POST["choice_user"])){
        $choiceUser = strip_tags(htmlspecialchars($_POST["choice_user"]));
        simulQuiz($choiceUser, $process, $idQuestionnaire, $optionCatch,$db);
    }
}

// var_dump($_SESSION["user-connect"]);
// $choiceUser = "En Russief";
// $sqlQuerry = "SELECT * FROM `choix_question` WHERE id_questionnaire = :qnb AND quest_number = :nbr AND quest_option = :opt AND correct = 1";
//    $sqlPrepare = $db->prepare($sqlQuerry);
//    $sqlPrepare->bindValue(":qnb", $idQuestionnaire, PDO::PARAM_INT);
//    $sqlPrepare->bindValue(":nbr", $process, PDO::PARAM_INT);
//    $sqlPrepare->bindValue(":opt", $choiceUser, PDO::PARAM_STR);
//    if($sqlPrepare->execute()){
//       $correctChoice = $sqlPrepare->fetch();
//       var_dump($correctChoice);
//       if($correctChoice == false){
//      }
//        else if($correctChoice["correct"] == 1){
//            $_SESSION['score']++;
//        }
//    }
?>
<section id="section-quiz-simulation">
    <h1>Simulation</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a href="./dashboard.php" class="stop-cancel">Arretez la simulation</a>
    <span>Le score : <?= !isset($_SESSION['score']) ? "0" : $_SESSION['score'] ;?></span>
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
                            <?=$opt["correct"]?>
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