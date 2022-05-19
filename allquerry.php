<?php
        ///////////////////to questionnaire
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
    
        //table option description
    $sqlGoCatchOption = "SELECT * FROM `choix_question` WHERE id_questionnaire = :idQuest AND id_from_user = :idUserActif ORDER BY num_response";
    $querryCatchOption = $db->prepare($sqlGoCatchOption);
    $querryCatchOption->bindValue(":idQuest",$idQuestionnaire,PDO::PARAM_INT);
    $querryCatchOption->bindValue(":idUserActif",$_SESSION['user-connect']['id'],PDO::PARAM_INT);

    ///questionnaire all
    $sqlGoAllQuest = "SELECT * FROM `theme_quest` ORDER BY id_from_of_questionnaire";
    $allCatch = $db->prepare($sqlGoAllQuest);

    if($querryCatch->execute() && $querryCatchTheme->execute() && $querryCatchOption->execute() &&  $allCatch->execute()){
        $questionnaireCatch = $querryCatch->fetchAll();
        $themeCatch = $querryCatchTheme->fetchAll();
        $optionCatch = $querryCatchOption->fetchAll();
        $catchAll = $allCatch->fetchAll();
    }