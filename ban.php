<?php
require_once "./includ-global/connectdatabase.php";
function check_if_banned($db,$login_attempt = false,$login_success = false){
        //limite 3 tentative de connexion
    $limit = 3;
    $ip = get_ip();

    $querryCheckIp = "SELECT * FROM `ip-bloc` WHERE ip_adresse = :ipCatch LIMIT 1";
    $preQuerry = $db->prepare($querryCheckIp);

        //check if prepare good
        $preQuerry->bindValue(":ipCatch", $ip, PDO::PARAM_STR);
        if($preQuerry->execute()){
            $colonne = $preQuerry->fetchAll();
            if(is_array($colonne) && count($colonne) > 0){
                $colonne = $colonne[0];

                $time = time();
                if($colonne["banned"] > $time){
                        //dajà bannie redirection
                    header("Location: ./banned.php");
                    die;
                }else{
                    if($login_attempt){
                        if($colonne["login_count"] >= $limit){
                            $querryUp = "UPDATE `ip-bloc` SET banned = :banned, login_count = 0 WHERE id = :id LIMIT 1";

                            $expire = ($time + (60 * 1));
                            $preQuerry = $db->prepare($querryUp);
                            $check = $preQuerry->execute([
                                'id'=>$colonne["id"],
                                'banned'=>$expire,
                            ]);
                         return;
                        }else{
                            if($login_success){
                                    //reset login count if sucess
                                $querryUpSucess = "UPDATE `ip-bloc` SET login_count = 0 WHERE id = :id LIMIT 1";
                                $preQuerry = $db->prepare($querryUpSucess);
                                $check = $querryUpSucess->execute([
                                    "id"=>$colonne["id"],
                                ]);
                            }else{
                                    //add login cou
                                $querry = "UPDATE `ip-bloc` SET login_count = login_count + 1 WHERE id = :id LIMIT 1";

                                $preQuerry = $db->prepare($querry);
                                $check = $preQuerry->execute([
                                    "id"=>$colonne["id"]
                                ]);
                            }
                        }
                    }
                }
                //return stop la function et cela signie qu'il a trouvé l'adresse ip
                return;
            }
        }
    //si il a pas trouvé l'adresse ip la function vient exécuté ce script
    $banned = 0;
    $login_count = 0;
    $querry = "INSERT INTO `ip-bloc` (ip_adresse, banned, login_count) VALUES (:ipAdress, :banned, :countLogin)";
    $preQuerry = $db->prepare($querry);
    $preQuerry->bindValue(":ipAdress",$ip);
    $preQuerry->bindValue(":banned",$banned);
    $preQuerry->bindValue(":countLogin",$login_count);
    $check = $preQuerry->execute();
}

function get_ip(){
    $ip = "";
    if(isset($_SERVER["HTTPS_X_FORWARDED_FOR"])){
        return $_SERVER["HTTPS_X_FORWARDED_FOR"];
    }
    if(isset($_SERVER["REMOTE_ADDR"])){
        return $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}