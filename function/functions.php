<?php
//inscription
$msgErreur ="";
function checkMdp(){
    // require_once "./inscription.php";
    $newPseudo =$_POST['pseudo-inscription'];
    $newMail =$_POST['mail-inscription'];
    $newPassWord =$_POST['password-inscription'];
    $newConfirmePass =$_POST['conf-pass-inscription'];
    if(isset($newPseudo, $newMail, $newPassWord, $newConfirmePass) && !empty($newPseudo) && !empty($newMail) && !empty($newPassWord) && !empty($newConfirmePass)){
       $msgErreur = "Veuillez ...";
    }
    // $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number    = preg_match('@[0-9]@', $password);
    // $lenght    = preg_match('@[0-9]@', $password);
    // $caractSpécial    = preg_match('@[\W]@', $password);
     return $msgErreur;
}