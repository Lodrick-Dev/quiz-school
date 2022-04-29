<?php
// session_start();
// $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number    = preg_match('@[0-9]@', $password);
    // $lenght    = preg_match('@[8,]@', $password); //au moin 8 caractère
    // $caractSpécial    = preg_match('@[\W]@', $password);
//function inscription
function inscript($newPseudo, $newMail, $newPassWord, $newConfirmePass, $db){
   $msgErreur ="";
    if(isset($newPseudo, $newMail, $newPassWord, $newConfirmePass) && !empty($newPseudo) && !empty($newMail) && !empty($newPassWord) && !empty($newConfirmePass)){
       if(strlen($newPseudo) <= 20){
          if(filter_var($newMail, FILTER_VALIDATE_EMAIL)){
             if(preg_match('@[A-Z]@', $newPassWord) && preg_match('@[a-z]@', $newPassWord) && preg_match('@[0-9]@', $newPassWord) && preg_match('@[\W]@', $newPassWord)){
                if(strlen($newPassWord) >= 8){
                   if($newPassWord === $newConfirmePass){
                        $newPassWord = password_hash($newPassWord, PASSWORD_ARGON2ID);
                        //check if pseudo in data base
                        $checkPseudoSql = "SELECT * FROM `users` WHERE `pseudo` = :newPseudo";
                        $prepareCheckPseudo = $db->prepare($checkPseudoSql);
                        $prepareCheckPseudo->bindValue(":newPseudo", $newPseudo, PDO::PARAM_STR);
                        if($prepareCheckPseudo->execute()){
                           $pseudoCheckInBase = $prepareCheckPseudo->fetch();
                           if($pseudoCheckInBase){
                              $msgErreur = "Ce pseudo existe déjà...";
                           }else{
                              //check if email existe in data base
                              $checkMailSql = "SELECT * FROM `users` WHERE `email` = :newMail";
                              $prepareCheckMail = $db->prepare($checkMailSql);
                              $prepareCheckMail->bindValue(":newMail", $newMail, PDO::PARAM_STR);
                              if($prepareCheckMail->execute()){
                                 $mailCheckInBase = $prepareCheckMail->fetch();
                                 if($mailCheckInBase){
                                    $msgErreur = "Cet adresse mail existe déjà...";
                                 }else{
                                    $sqlInsert = "INSERT INTO `users` (`pseudo`, `email`, `password_user`) VALUES (:pseudoIns, :emailIns, :passwordIns)";

                                    //prepare
                                    $querryTo = $db->prepare($sqlInsert);
                                    $querryTo->bindValue(':pseudoIns', $newPseudo, PDO::PARAM_STR);
                                    $querryTo->bindValue(':emailIns',$newMail, PDO::PARAM_STR);
                                    $querryTo->bindValue(':passwordIns',$newPassWord, PDO::PARAM_STR);

                                    if(!$querryTo->execute()){
                                       $msgErreur = "Une erreur est survenue lors de l'inscription...";
                                    }else{
                                       $last_id = $db->lastInsertId();
                                       //fetch last user
                                       $goFetch = "SELECT * FROM `users` WHERE `id_user` = :id_last";
                                       $goPrepare = $db->prepare($goFetch);
                                       $goPrepare->bindValue(':id_last', $last_id, PDO::PARAM_INT);
                                       if(!$goPrepare->execute()){
                                          $msg = "Waw une erreur est survenue là il faut pas !";
                                       }else{
                                          $last_user_add = $goPrepare->fetch();

                                          $_SESSION["user-connect"] = [
                                             "id"=> $last_id,
                                             "nom"=> $last_user_add['nom'],
                                             "prenom"=> $last_user_add['prenom'],
                                             "pseudo"=> $last_user_add['pseudo'],
                                             "mail" => $last_user_add['email'],
                                             "profil" => $last_user_add['profil_img'],
                                             "bio" => $last_user_add['biography'],
                                             "statut" => $last_user_add['statut_user'],
                                             "date" => $last_user_add['creat_date']
                                          ];
                                          header("Location: ../dashboard.php");
                                       }
                                    }
                                 }
                              }else{
                                 $msgErreur = "Une erreur est survenue lors de la vérification de l'adresse mail...";
                              }
                           }
                        }else{
                           $msgErreur ="Une erreur est survenue lors de la vérification du pseudo...";
                        }
                     }else{
                        $msgErreur = "Mot de passe ne correspond pas...";
                     }
                }else{
                   $msgErreur = "Votre mot de passe doit contenir au moins 8 caractères...";
                }
             }else{
                $msgErreur ="Votre mot de passe doit contenir 1 majuscule, minuscule, nombre et caractère...";
             }
          }else{
            $msgErreur = "Lol email invalide...";
          }
       }else{
         $msgErreur = "Pseudo trop long...max 20 caractère";
       }
    }else{
      $msgErreur = "Veuillez remplir tous les champs...";
    }
     return $msgErreur;
}

//function connection
function connect($mailConnect, $passConnect, $db){
   if(isset($mailConnect, $passConnect) && !empty($mailConnect) && !empty($passConnect)){
      if(filter_var($mailConnect, FILTER_VALIDATE_EMAIL)){
            //Check if exist in database
         $sqlMailExistConnect = "SELECT * FROM `users` WHERE `email`= :mailCheck";
            //querry prepare
         $querryConnect = $db->prepare($sqlMailExistConnect);
         $querryConnect->bindValue(":mailCheck", $mailConnect, PDO::PARAM_STR);
         if($querryConnect->execute()){
            $mailConnectChecked = $querryConnect->fetch();
            if(!$mailConnectChecked){
               $msgErreur = "Email n'existe pas...";
            }else{
               if(!password_verify($passConnect, $mailConnectChecked['password_user'])){
                  $msgErreur = "Email ou mot de passe est incorrect...";
               }else{
                  // $userConnect = $querryConnect->fetch();
                  $_SESSION["user-connect"] = [
                     "id"=> $mailConnectChecked['id_user'],
                     "nom"=> $mailConnectChecked['nom'],
                     "prenom"=> $mailConnectChecked['prenom'],
                     "pseudo"=> $mailConnectChecked['pseudo'],
                     "mail" => $mailConnectChecked['email'],
                     "profil" => $mailConnectChecked['profil_img'],
                     "bio" => $mailConnectChecked['biography'],
                     "statut" => $mailConnectChecked['statut_user'],
                     "date" => $mailConnectChecked['creat_date']
                  ];
                  header("Location: ../dashboard.php");
               }
            }
         }else{
            $msgErreur = "Une erreur est survenue lors de la vérification de l'email...";
         }
      }else{
         $msgErreur = "Email invalide..";
      }
   }else{
      $msgErreur = "Veuillez remplir tous les champs..";
   }
   return $msgErreur;
}

//function updateprofil
function upProfil($upAvat, $upName, $upAutName, $upPseudo, $upMail, $upBio, $upPass, $db){
   if(isset($upAvat, $upName, $upAutName, $upPseudo, $upMail, $upBio, $upPass) && $upAvat["error"] === 0 && !empty($upName) && !empty($upAutName) && !empty($upPseudo) && !empty($upMail) && !empty($upBio) && !empty($upPass)){
      if(strlen($upName) <= 20 && strlen($upAutName) <= 20 && strlen($upPseudo) <= 20){
         if(filter_var($upMail, FILTER_VALIDATE_EMAIL)){
               //check if email exist
            $sqlCheckMailUp = "SELECT * FROM `users` WHERE `email` = :mailCheckUp";
               //prepare
            $querryPrepareUp = $db->prepare($sqlCheckMailUp);
            $querryPrepareUp->bindValue(':mailCheckUp', $upMail, PDO::PARAM_STR);
            if($querryPrepareUp->execute()){
               $mailCheckedNow = $querryPrepareUp->fetch();
               if(!$mailCheckedNow){
                  $msgErreur = "Désolé l'email n'existe pas chez nous...";
               }else{
                  if(password_verify($upPass, $mailCheckedNow['password_user'])){
                        //to check type name
                     $acceptImg = [
                        "jpg" => "image/jpeg",
                        "jpeg" => "image/jpeg",
                        "png" => "image/png",
                     ];
                        //catch file's name, file's stype, size's type
                     $fileName = $upAvat['name'];
                     $fileType = $upAvat['type'];
                     $fileSize = $upAvat['size'];

                        //catch extension with pathinfo and pathinfo_extension
                     $extensionCatch = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        //check if extension or type myme exist with $accept in file upload
                        //array_key_exists check if extension exist with $accept
                        //in_array check if type myme exist with $accept
                     if(!array_key_exists($extensionCatch, $acceptImg) || !in_array($fileType, $acceptImg)){
                        $msgErreur = "Format de votre fichier incorrect ...";
                     }else{
                        $maxUpload = 1500 * 1500;
                        if($fileSize > $maxUpload){
                           $msgErreur = "Fichier trop volumineux, max 2mo";
                        }else{
                              //to ranme n name' script
                           $newNameFile = md5(uniqid());

                                 //creat dossier
                                 //is_dir() to only file
                                 //file_exists() to file and case (fichier et dossier)
                              $filePseudoConnect = "./uploader/$upPseudo";
                           if(!is_dir($filePseudoConnect)){
                              mkdir($filePseudoConnect, 077, true);
                           }

                              //we put file in file n his new name
                           $newFileUnik = "./uploader/".$upPseudo."/".$newNameFile."".$_SESSION['user-connect']['id'].".".$extensionCatch;

                              //file is in fil temporair so we gone catch n we put it in new dossier
                           if(!move_uploaded_file($upAvat["tmp_name"], $newFileUnik)){
                              $msgErreur = "Le téléchargement de votre fichier a échoué... Bizarre !";
                           }else{
                                 //we forbidden execution script in file if it have but can read with 0644
                              chmod($newFileUnik, 0644);
                                 //we delete old avatar
                              if(!empty($_SESSION['user-connect']['profil'])){
                                 unlink($_SESSION['user-connect']['profil']);
                              };

                              $sqlUpdateProfil = "UPDATE `users` SET nom = :upNom, prenom = :upPrenom, pseudo = :upPseudo, email = :upMail, profil_img = :upImg, biography = :upBio WHERE id_user = :idUseUp";

                              $querryPrepareAddData = $db->prepare($sqlUpdateProfil);

                              $querryPrepareAddData->bindValue(":upNom", $upName, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":upPrenom", $upAutName, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":upPseudo", $upPseudo, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":upMail", $upMail, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":upImg", $newFileUnik, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":upBio", $upBio, PDO::PARAM_STR);
                              $querryPrepareAddData->bindValue(":idUseUp", $_SESSION['user-connect']['id'], PDO::PARAM_INT);
                              if($querryPrepareAddData->execute()){
                                 $sqlUpDateDid = "SELECT * FROM `users` WHERE id_user = :idUs";

                                 $querryGoCatch = $db->prepare($sqlUpDateDid);
                                 $querryGoCatch->bindValue(":idUs", $_SESSION['user-connect']['id'], PDO::PARAM_INT);
                                 if($querryGoCatch->execute()){
                                    $userUpDateDidConnect = $querryGoCatch->fetch();
                                    if($userUpDateDidConnect){
                                       $_SESSION["user-connect"] = [
                                          "id" => $userUpDateDidConnect['id_user'],
                                          "nom" => $userUpDateDidConnect['nom'],
                                          "prenom" => $userUpDateDidConnect['prenom'],
                                          "pseudo" => $userUpDateDidConnect['pseudo'],
                                          "mail" => $userUpDateDidConnect['email'],
                                          "profil" => $userUpDateDidConnect['profil_img'],
                                          "bio" => $userUpDateDidConnect['biography'],
                                          "statut" => $userUpDateDidConnect['statut_user'],
                                          "date" => $userUpDateDidConnect['creat_date'],
                                       ];
                                       header("Location: ../dashboard.php");
                                    }else{
                                       $msgErreur = "Une erreur est survenue lors de la récupération des données de l'utilisateur...";
                                    }
                                 }else{
                                    $msgErreur = "Une erreur est survenue lors de l'exécution la récupération des données de l'utilisateur...";
                                 }
                              }else{
                                 $msgErreur = "Une erreur est survenue lors de la mise à jour de votre profil...";
                              }
                           }
                        }
                     }
                  }else{
                     $msgErreur = "Mot de passe incorrect...";
                  }
               }
            }else{
               $msgErreur = "Wesh une erreur est survenue lors de la vérification de mail";
            }
         }else{
            $msgErreur = "Lol email invalide ...";
         }
      }else{
         $msgErreur = "Trop de caractère ! Max 20 caractères ...";
      }
   }else{
      $msgErreur = "veuillez remplir tous les champs...";
   }
   return $msgErreur;
}

//function create msg
function creatingQuestion($numberOfQuestionnaire,$themeQuest,$descripQuest,$idOneQuest,$questOneCreat,$questOneFirstCreat,$questOneSecondCreat,$questOneThreeCreat,$questOneTrueCreat,$idTwoQuest,$questTwoCreat,$questTwoFirstCreat,$questTwoSecondCreat,$questTwoThreeCreat,$questTwoTrueCreat,$idThreeQuest,$questThreeCreat,$questThreeFirstCreat,$questThreeSecondCreat,$questThreeThreeCreat,$questThreeTrueCreat ,$db){
   if(isset($numberOfQuestionnaire,$themeQuest,$descripQuest,$idOneQuest,$questOneCreat,$questOneFirstCreat,$questOneSecondCreat,$questOneThreeCreat,$questOneTrueCreat,$idTwoQuest,$questTwoCreat,$questTwoFirstCreat,$questTwoSecondCreat,$questTwoThreeCreat,$questTwoTrueCreat,$idThreeQuest,$questThreeCreat,$questThreeFirstCreat,$questThreeSecondCreat,$questThreeThreeCreat,$questThreeTrueCreat) && !empty($numberOfQuestionnaire ) && !empty($themeQuest) && !empty($descripQuest) && !empty($idOneQuest) &&!empty($questOneCreat) && !empty($questOneFirstCreat) && !empty($questOneSecondCreat) && !empty($questOneThreeCreat) && !empty($questOneTrueCreat) && !empty($idTwoQuest) && !empty($questTwoCreat) && !empty($questTwoFirstCreat) && !empty($questTwoSecondCreat) && !empty($questTwoThreeCreat) && !empty($questTwoTrueCreat) && !empty($idThreeQuest) && !empty($questThreeCreat) && !empty($questThreeFirstCreat) && !empty($questThreeSecondCreat) && !empty($questThreeThreeCreat) && !empty($questThreeTrueCreat)){
      
      $sqlToTheme = "INSERT INTO `theme_quest` (`theme`,`description`,`id_from_of_questionnaire`,`id_from_user`) VALUE (:them, :descript, :idFromOfQuest, :idFromUser)";
      $sqlThemeAdd = $db->prepare($sqlToTheme);
      $sqlThemeAdd->bindValue(":them",$themeQuest,PDO::PARAM_STR);
      $sqlThemeAdd->bindValue(":descript",$descripQuest,PDO::PARAM_STR);
      $sqlThemeAdd->bindValue(":idFromOfQuest",$numberOfQuestionnaire,PDO::PARAM_INT);
      $sqlThemeAdd->bindValue(":idFromUser",$_SESSION["user-connect"]["id"],PDO::PARAM_INT);

      $sqlToAddFirst = "INSERT INTO `questionnaire`(`id_of_questionnaire`,`id_quest`,`question`,`rep_one`,`rep_two`, `rep_three`,`rep_true`, `id_from_user`) VALUE (:idOfQuest,:idQuest, :question, :respOne, :respTwo, :respThree, :respTrue, :idFromUser),
      (:idOfQuest,:idQuest1, :question1, :respOne1, :respTwo1, :respThree1, :respTrue1, :idFromUser1),
      (:idOfQuest,:idQuest2, :question2, :respOne2, :respTwo2, :respThree2, :respTrue2, :idFromUser2)";
         //prepare
      $reqPrepareFirst = $db->prepare($sqlToAddFirst);
      $reqPrepareFirst->bindValue(":idOfQuest",$numberOfQuestionnaire, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idQuest",$idOneQuest, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":question",$questOneCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respOne",$questOneFirstCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTwo",$questOneSecondCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respThree",$questOneThreeCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTrue",$questOneTrueCreat, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idFromUser",$_SESSION["user-connect"]["id"], PDO::PARAM_INT);
         //second inject
      // $reqPrepareSecond = $db->prepare($sqlToAddFirst);
      $reqPrepareFirst->bindValue(":idOfQuest1",$numberOfQuestionnaire , PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idQuest1",$idTwoQuest, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":question1",$questTwoCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respOne1",$questTwoFirstCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTwo1",$questTwoSecondCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respThree1",$questTwoThreeCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTrue1",$questTwoTrueCreat, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idFromUser1",$_SESSION["user-connect"]["id"], PDO::PARAM_INT);
      //treeth inject
      // $reqPrepareThree = $db->prepare($sqlToAddFirst);
      $reqPrepareFirst->bindValue(":idOfQuest2",$numberOfQuestionnaire , PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idQuest2",$idThreeQuest, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":question2",$questThreeCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respOne2",$questThreeFirstCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTwo2",$questThreeSecondCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respThree2",$questThreeThreeCreat, PDO::PARAM_STR);
      $reqPrepareFirst->bindValue(":respTrue2",$questThreeTrueCreat, PDO::PARAM_INT);
      $reqPrepareFirst->bindValue(":idFromUser2",$_SESSION["user-connect"]["id"], PDO::PARAM_INT);
      // $msgErreur = "ok ici !";
      $msgErreur ="";

      if($sqlThemeAdd->execute() && $reqPrepareFirst->execute()){
        header("Location: ../dashboard.php");
      }else{
         $msgErreur = "Une erreur lors de l'exécution... ";
      }
   }else{
      $msgErreur = "Veuillez remplir tous les champs ...";
   }
   return $msgErreur;
}