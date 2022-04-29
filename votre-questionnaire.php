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

    //table questionnaire
$sqlGoCatchQuest = "SELECT * FROM `questionnaire` WHERE id_of_questionnaire = :idQuestCall AND id_from_user = :idUserActif";
$querryCatch = $db->prepare($sqlGoCatchQuest);
$querryCatch->bindValue(":idQuestCall", $idQuestionnaire, PDO::PARAM_INT);
$querryCatch->bindValue(":idUserActif", $_SESSION['user-connect']['id'], PDO::PARAM_INT);

    //table theme description
$sqlGoCatchTheme = "SELECT * FROM `theme_quest` WHERE id_from_of_questionnaire = :idQuestCall AND id_from_user = :idUserActif";
$querryCatchTheme = $db->prepare($sqlGoCatchTheme);
$querryCatchTheme->bindValue(":idQuestCall",$idQuestionnaire,PDO::PARAM_INT);
$querryCatchTheme->bindValue(":idUserActif",$_SESSION['user-connect']['id'],PDO::PARAM_INT);

if($querryCatch->execute() && $querryCatchTheme->execute()){
    $questionnaireCatch = $querryCatch->fetchAll();
    $themeCatch = $querryCatchTheme->fetchAll();
}
var_dump($questionnaireCatch);
echo $questionnaireCatch[0]["rep_one"];
echo $idQuestionnaire;
var_dump($themeCatch);
?>
<section id="display-questionnary">
    <h1>Votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <div id="box-questionnary-display">
        <h2>Theme : <?= $themeCatch[0]["theme"]?>  </h2>
        <!-- php -->
        ?>
        <?php foreach( $questionnaireCatch as $question) :?>

        <div class="box-boucl">
            <div class="box-quest">
                <p><?=$question["question"]?></p>
                <div class="answer">
                    <span>
                    <?= $question["rep_true"] == 1 ? "Bonne réponse" : "Réponse" ?>
                         <strong><?=$question["rep_one"]?></strong>
                    </span>
                    <span>
                        <?= $question["rep_true"] == 2 ? "Bonne réponse" : "Réponse" ?>
                         <strong><?=$question["rep_two"]?></strong>
                    </span>
                    <span>
                        <?= $question["rep_true"] == 3 ? "Bonne réponse" : "Réponse" ?>
                         <strong><?=$question["rep_three"]?></strong>
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach;
        ?>
        <!-- php -->
        <div id="box-link-on-simul">
            <a href="./quiz-simulation.php">Faire une simulation</a>
            <a href="./edit-questionnaire.php">Modifier le questionnaire</a>
        </div>
    </div>
</section>
<?php
    require_once "./includ-global/footer.php";

    // <?php foreach ($variable as $key => $value) {
    //     # code...
    // }?>
    // <?php ?>