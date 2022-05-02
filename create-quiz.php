<?php
session_start();
$titre_web = "Création - QUIZ-SCHOOL";
require_once "./treat/to-connexion.php";
require_once "./includ-global/connectdatabase.php";
require_once "./function/functions.php";
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
$tothree = 3;
if(isset($_POST['choose-numb-quest-add'])){
    $three = "trois";
    $six = "six";
    $nine = "neuf";
    $eleven = "douze";
    $valueSelect = strip_tags(htmlspecialchars($_POST['select-how-quest']));
    var_dump($valueSelect);
    if($valueSelect == $three){
        $_SESSION['number-quest'] = $valueSelect;
    }else if($valueSelect == $six){
        $_SESSION['number-quest'] = $valueSelect;   
    }else if($valueSelect == $nine){
        $_SESSION['number-quest'] = $valueSelect;   
    }else if($valueSelect == $eleven){
        $_SESSION['number-quest'] = $valueSelect;   
    }
    var_dump($_SESSION['number-quest']);
}

//to add quest
if(isset($_POST['submit-creat-question'])){
    $numberOfQuestionnaire = strip_tags(htmlspecialchars($_POST['number-of-questionnaire']));
    $themeQuest = strip_tags(htmlspecialchars($_POST['text-theme-creat-quest']));
    $descripQuest = strip_tags(htmlspecialchars($_POST['text-descrip-creat-quest']));
    //change value now 0
    $id1Quest = strip_tags(htmlspecialchars($_POST["number-quest-creat-quest0"]));
    $quest1 = strip_tags(htmlspecialchars($_POST["quest-creat-quest0"]));
    $option1To1 = strip_tags(htmlspecialchars($_POST["quest-first-creat-quest0"]));
    $option2To1 = strip_tags(htmlspecialchars($_POST["quest-second-creat-quest0"]));
    $option3To1 = strip_tags(htmlspecialchars($_POST["quest-three-creat-quest0"]));
    $optionGoodTo1 = strip_tags(htmlspecialchars($_POST["number-quest-true-creat-quest0"]));
    //change value now 1
    $id2Quest = strip_tags(htmlspecialchars($_POST["number-quest-creat-quest1"]));
    $quest2 = strip_tags(htmlspecialchars($_POST["quest-creat-quest1"]));
    $option1To2 = strip_tags(htmlspecialchars($_POST["quest-first-creat-quest1"]));
    $option2To2  = strip_tags(htmlspecialchars($_POST["quest-second-creat-quest1"]));
    $option3To2 = strip_tags(htmlspecialchars($_POST["quest-three-creat-quest1"]));
    $optionGoodTo2 = strip_tags(htmlspecialchars($_POST["number-quest-true-creat-quest1"]));
    //change value now 2
    $id3Quest = strip_tags(htmlspecialchars($_POST["number-quest-creat-quest2"]));
    $quest3 = strip_tags(htmlspecialchars($_POST["quest-creat-quest2"]));
    $option1To3 = strip_tags(htmlspecialchars($_POST["quest-first-creat-quest2"]));
    $option2To3 = strip_tags(htmlspecialchars($_POST["quest-second-creat-quest2"]));
    $option3To3 = strip_tags(htmlspecialchars($_POST["quest-three-creat-quest2"]));
    $optionGoodTo3 = strip_tags(htmlspecialchars($_POST["number-quest-true-creat-quest0"]));

    //function call
    $msgErreur = creatingQuestion($numberOfQuestionnaire ,$themeQuest,$descripQuest,$id1Quest,$quest1,$option1To1,$option2To1,$option3To1,$optionGoodTo1, $id2Quest,$quest2,$option1To2,$option2To2,$option3To2,$optionGoodTo2, $id3Quest,$quest3,$option1To3,$option2To3,$option3To3,$optionGoodTo3,$db);
    // unset($_SESSION['number-quest']);
}
    if($_SESSION["choose"]){
        header("Location: ./dashboard.php");
    }

var_dump($_SESSION['number-quest']);

$numberOfQuestionnaire  = "boba";
$themeQuest = "bobab";
$descripQuest = "bobabc";
$id1Quest = "bobabcde";
$quest1 = "bobabcdef";

$directors = array( "Alfred Hitchcock", "Stanley Kubrick", "Martin Scorsese", "Fritz Lang" );

$valuetoAdd = array($numberOfQuestionnaire ,$themeQuest,$descripQuest,$id1Quest,$quest1);
// var_dump($valuetoAdd);
// var_dump($directors);
// foreach($valuetoAdd as $key){
//     echo $key ."<br>";
// }
?>
<section id="section-creat-quiz">
<h1>Création de votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a id="link-cancel" href="./dashboard.php">Annuler</a>
    <div id="box-glob-creat-questions">
        <div id="box-to-form-select-numb">
            <form action="" method="post">
                <label for="">Combien de question ?</label>
                <select name="select-how-quest" id="">
                    <option value="null">--Null--</option>
                    <option value="trois" <?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "trois" ? "selected" : "" ?>>--3--</option>
                    <option value="six" <?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "six" ? "selected" : "" ?>>--6--</option>
                    <option value="neuf" <?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "neuf" ? "selected" : "" ?> >--9--</option>
                    <option value="douze" <?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "douze" ? "selected" : "" ?> >--12--</option>
                </select>
                <input type="submit" value="Commencer" name="choose-numb-quest-add">
            </form>
        </div>
        <form action="" method="post">
        <span class="msg-to-user-form"><?= isset($msgErreur) ? $msgErreur : ""?></span>
            <div class="box-creat-quest">
                <label for="">Numéro du questionnaire :</label>
                <input type="number" name="number-of-questionnaire" class="nm-ber-quest" value="1" min ="1">
            </div>
            <div class="box-creat-them-quest">
                <label for="">Theme :</label>
                <input type="text" placeholder ="Votre thème..." name="text-theme-creat-quest">
            </div>
            <div class="box-creat-descrip-quest">
                <label for="">Description :</label>
                <textarea name="text-descrip-creat-quest" id="" cols="30" rows="10" placeholder ="Aucune description..."></textarea>
            </div>
            <!-- <div id="separe-in-form-creat-questions"></div> -->
            <!-- php boucl -->
            <?php
            if(isset($_SESSION['number-quest'])){
                switch($_SESSION['number-quest']){
                    case "trois":
                        for($i = 0; $i < $tothree; $i++){
                            ?>
                                <div id="separe-in-form-creat-questions"></div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                <label for="">Numéro de question :</label>
                            <input type="number" name="number-quest-creat-quest<?=$i?>" class="nm-ber-quest" value="1" min="1" max ="<?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "six" ? "6" : "12" ?>">
                            </div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                Question :
                                <input type="text" name="quest-creat-quest<?=$i?>" placeholder ="Votre question">
                            </div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                <label for="">Réponse 1 :</label>
                                <input type="text" name="quest-first-creat-quest<?=$i?>">
                            </div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                <label for="">Réponse 2 :</label>
                                <input type="text" name="quest-second-creat-quest<?=$i?>">
                            </div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                <label for="">Réponse 3 :</label>
                                <input type="text" name="quest-three-creat-quest<?=$i?>">
                            </div>
                            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                                <label for="">Bonne Réponse : </label>
                                <input type="number" name="number-quest-true-creat-quest<?=$i?>" class="nm-ber-quest" value="1" max="3" min="1">
                            </div>


                            <?php
                        }
                        break;
                }
            }
             ?>
            <!-- <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <label for="">Numéro de question :</label>
                <input type="number" name="" class="nm-ber-quest" value="1" min="1" max ="<?=isset($_SESSION['number-quest']) && $_SESSION['number-quest'] == "six" ? "6" : "12" ?>">
            </div>
            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                Question :
                <input type="text" placeholder ="Votre question">
            </div>
            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <label for="">Réponse 1 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <label for="">Réponse 2 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <label for="">Réponse 3 :</label>
                <input type="text">
            </div>
            <div class="box-creat-quest <?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <label for="">Bonne Réponse : </label>
                <input type="number" class="nm-ber-quest" value="1" max="3" min="1">
            </div> -->
            <!-- php -->
            <div id="box-btn-sub-creat-questions" class="<?=isset($_SESSION['number-quest']) ? "" : "waiting-option-user-number"?>">
                <input type="submit" value="Envoyer" name ="submit-creat-question">
            </div>
        </form>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";