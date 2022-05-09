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
$sqlGoCatchQuest = "SELECT * FROM `questionnaire` WHERE id_of_questionnaire = :idQuestCall AND id_from_user = :idUserActif ORDER BY id_quest ";
$querryCatch = $db->prepare($sqlGoCatchQuest);
$querryCatch->bindValue(":idQuestCall", $idQuestionnaire, PDO::PARAM_INT);
$querryCatch->bindValue(":idUserActif", $_SESSION['user-connect']['id'], PDO::PARAM_INT);

    //table theme description
$sqlGoCatchTheme = "SELECT * FROM `theme_quest` WHERE id_from_of_questionnaire = :idQuestCall AND id_from_user = :idUserActif ";
$querryCatchTheme = $db->prepare($sqlGoCatchTheme);
$querryCatchTheme->bindValue(":idQuestCall",$idQuestionnaire,PDO::PARAM_INT);
$querryCatchTheme->bindValue(":idUserActif",$_SESSION['user-connect']['id'],PDO::PARAM_INT);

    //table theme description
$sqlGoCatchOption = "SELECT * FROM `choix_question` WHERE id_questionnaire = :idQuest AND id_from_user = :idUserActif ORDER BY quest_number";
$querryCatchOption = $db->prepare($sqlGoCatchOption);
$querryCatchOption->bindValue(":idQuest",$idQuestionnaire,PDO::PARAM_INT);
$querryCatchOption->bindValue(":idUserActif",$_SESSION['user-connect']['id'],PDO::PARAM_INT);

$arra = [];
if($querryCatch->execute() && $querryCatchTheme->execute() && $querryCatchOption->execute()){
    $questionnaireCatch = $querryCatch->fetchAll();
    $themeCatch = $querryCatchTheme->fetchAll();
    $optionCatch = $querryCatchOption->fetchAll();
}

var_dump($questionnaireCatch);
// var_dump($themeCatch);
// var_dump($optionCatch);
$op1 = [];
$op2 = [];
$op3 = [];
foreach ($optionCatch as $key => $value) {
    if($value["quest_number"] == '1'){
        $op1[] = $value["quest_option"];
    }else if($value["quest_number"] == '2'){
        $op2[] = $value["quest_option"];
    }else{
        $op3[] = $value["quest_option"];
    }
}
var_dump($op1);
var_dump($op2);
var_dump($op3);
echo $op1[0];
?>
<section id="display-questionnary">
    <h1>Votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <div id="box-questionnary-display">
        <h2>Theme : <?= $themeCatch[0]["theme"]?> </h2>
        <!-- php -->
        <?php $am = 0; $amm = 0; $az = 0;?>
        <?php foreach( $questionnaireCatch as $question) :?>
                <div class="box-boucl">
                    <div class="box-quest">
                        <p><?=$question["question"]?></p>
                        <div class="answer">
                            <span>
                                <?php if($am == 0 ){
                                    echo $op1[$am];
                                    $am++;
                                    }else if($am == 3){
                                        // $amm = 0;
                                        echo $op2[$amm];
                                         $amm++;
                                        }
                                        if($amm === 3){
                                            // $a = 0;
                                            echo $op3[$az];
                                             $az++;
                                            }?>
                            </span>
                            <span>
                                <?php if($am == 1 ){
                                    echo $op1[$am];
                                    $am++;
                                }else if($amm == 1){
                                    echo $op2[$amm];
                                     $amm++;
                                }
                                if($az === 1){
                                     echo $op3[$az];
                                     $az++;
                                }?>
                            </span>
                            <span>
                                <?php if($am == 2 ){
                                    echo $op1[$am];
                                    $am++;
                                }else if($amm == 2){
                                    echo $op2[$amm];
                                     $amm++;
                                }
                                if($az === 2){
                                    echo $op3[$az]; 
                                    $az++;
                                }?>
                            </span>
                        </div>
                    </div>
                </div>
        <?php endforeach;?>
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