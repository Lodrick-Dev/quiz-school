<?php
// session_start();
// $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number    = preg_match('@[0-9]@', $password);
    // $lenght    = preg_match('@[8,]@', $password); //au moin 8 caractère
    // $caractSpécial    = preg_match('@[\W]@', $password);
//inscription
// require_once "./includ-global/connectdatabase.php";
function checkMdp($newPseudo, $newMail, $newPassWord, $newConfirmePass, $db){
   $msgErreur ="";
    if(isset($newPseudo, $newMail, $newPassWord, $newConfirmePass) && !empty($newPseudo) && !empty($newMail) && !empty($newPassWord) && !empty($newConfirmePass)){
       if(strlen($newPseudo) < 5){
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
                                             "date" => $last_user_add['creat_date'],
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