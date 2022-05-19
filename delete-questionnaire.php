<?php
require_once "./includ-global/connectdatabase.php";
$idQuest = $_GET["id-quest"];
$idUser = $_GET["iU"];

echo $idQuest."<br>";
echo $idUser."<br>";

// $sqlTheme = "DELETE * FROM `theme_quest` WHERE id_from_user = :idU
$sqlTheme = "DELETE FROM `theme_quest` WHERE id_from_of_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepare = $db->prepare($sqlTheme);
$sqlPrepare->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepare->bindValue(":idU", $idUser, PDO::PARAM_INT);

$sqlQuest = "DELETE FROM `questionnaire` WHERE id_of_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepareQuest = $db->prepare($sqlQuest);
$sqlPrepareQuest->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepareQuest->bindValue(":idU", $idUser, PDO::PARAM_INT);


$sqlOption = "DELETE FROM `choix_question` WHERE id_questionnaire = :idQ AND id_from_user = :idU";
$sqlPrepareOption = $db->prepare($sqlOption);
$sqlPrepareOption->bindValue(":idQ", $idQuest, PDO::PARAM_INT);
$sqlPrepareOption->bindValue(":idU", $idUser, PDO::PARAM_INT);


if($sqlPrepare->execute() && $sqlPrepareQuest->execute() && $sqlPrepareOption->execute()){
    $catchThe = $sqlPrepare->fetch();
    $catchQuest = $sqlPrepareQuest->fetch();
    $catchOption = $sqlPrepareOption->fetch();
    var_dump($catchThe);
    var_dump($catchQuest);
    var_dump($catchOption);
    // header("Location: ./dashboard.php");
}