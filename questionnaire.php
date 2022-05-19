<?php
session_start();
require_once "./includ-global/connectdatabase.php";
$idQuest = $_GET["id_quest"];
$idUser = $_GET["iU"];
$process = $_GET['nbP'];
$titre_web = "Création - QUIZ-SCHOOL";

$sqlTheme = "SELECT * FROM `theme_quest` WHERE id_from_of_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepare = $db->prepare($sqlTheme);
$sqlPrepare->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepare->bindValue(":idU", $idUser, PDO::PARAM_INT);

$sqlQuest = "SELECT * FROM `questionnaire` WHERE id_of_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepareQuest = $db->prepare($sqlQuest);
$sqlPrepareQuest->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepareQuest->bindValue(":idU", $idUser, PDO::PARAM_INT);

if(!isset($_SESSION["score"])){
    $_SESSION["score"] = 0;
}

$sqlOption = "SELECT * FROM `choix_question` WHERE id_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepareOption = $db->prepare($sqlOption);
$sqlPrepareOption->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepareOption->bindValue(":idU", $idUser, PDO::PARAM_INT);


if($sqlPrepare->execute() && $sqlPrepareQuest->execute() && $sqlPrepareOption->execute()){
    $catchThe = $sqlPrepare->fetch();
    $catchQuest = $sqlPrepareQuest->fetchAll();
    $catchOption = $sqlPrepareOption->fetchAll();
    // var_dump($catchThe);
    // var_dump($catchQuest);
    // var_dump($catchOption);
    // header("Location: ./dashboard.php");
}
// require_once "./treat/to-connexion.php";
$idShare = $_SESSION["user-connect"]["id"];
require_once "./function/functions.php";
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";

if(isset($_POST["btn-quest"])){
    if(isset($_POST["choice_user_play"]) && !empty($_POST["choice_user_play"])){
        $choiceUser = strip_tags(htmlspecialchars($_POST["choice_user_play"]));
        playQuiz($choiceUser, $process, $idQuest, $idShare, $db);
    }else{
        $msgE = "Veuillez choisir sélectionner un choix";
    }
}
?>
<section id="section-questionnaire">
    <div class="div-glob">
        <div class="them-quest">
            <h1>Le theme : <strong><?= $catchThe["theme"]?></strong></h1>
        </div>
        <div class="iv-score">
        Le score :
            <span><?= !isset($_SESSION['score']) ? "0" : $_SESSION['score'] ;?></span>
        </div>
        <div id="msg-use-play">
            <?= isset($msgE) ? $msgE : ""?>
        </div>
        <?php foreach($catchQuest as $quest):?>
        <form action="" method="post" class="<?= $process == $quest["id_quest"] ? "visi" : "invi" ?>">
            <h2><?= $quest["question"] ?></h2>
            <div id="box-glob-of-div-n-input">
                <?php
                $idQuest = $quest["id_quest"];
                shuffle($catchOption);
                foreach($catchOption as $opt){
                    if($idQuest == $opt["quest_number"]){
                        ?>
                        <div>
                            <input type="radio" name="choice_user_play" id="<?= $opt["quest_option"]?>" value="<?= $opt["quest_option"]?>">
                            <label for="<?= $opt["quest_option"]?>"><?=$opt["quest_option"]?></label>
                            <?=$opt["correct"]?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="btn-to-questionnaire-val">
                <input type="submit" value="Valider" name="btn-quest">
            </div>
        </form>
        <?php endforeach;?>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";