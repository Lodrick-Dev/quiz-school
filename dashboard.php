<?php
session_start();
require_once "./includ-global/connectdatabase.php";
if(!isset($_SESSION['user-connect'])){
    header("Location: ./connexion.php");
}
if(isset($_SESSION['number-quest'])){
    unset($_SESSION['number-quest']);
}
if(isset($_SESSION["choose"])){
    unset($_SESSION["choose"]);
}

$titre_web = "Dashboard - QUIZ-SCHOOL";

require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";


$sqlGoCatchThem = "SELECT * FROM `theme_quest` WHERE id_from_user = :id_actif_theme";
$leUser = 12;
$process = 1;

$querryCatchThem = $db->prepare($sqlGoCatchThem);
$querryCatchThem->bindValue(":id_actif_theme", $_SESSION['user-connect']['id'], PDO::PARAM_INT);
if($querryCatchThem->execute()){
   $themeCatch = $querryCatchThem->fetchAll();
}
unset($_SESSION['score']);
?>
<section id="section-dashboard">
    <h1>TABLEAU DE BORD</h1>
    <div id="box-card-from-dash">
        <div class="card-from-dash">
            <div id="card-profil-from-dash">
                <h1>Votre profil</h1>
            </div>
            <div class="info-card-profil">
                <img src="<?=$_SESSION['user-connect']['profil'] == null ? "./file/avatardefault/bear-gf5600b6ed_1920.png" : $_SESSION['user-connect']['profil']?>" alt="" srcset="">
            </div>
            <div class="info-card-profil">
                <span>Nom :</span>
                <strong><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["nom"] == null ? "Non défini" : $_SESSION["user-connect"]["nom"] ?></strong>
            </div>
            <div class="info-card-profil">
                <span>Prénom :</span>
                <strong><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["prenom"] == null ? "Non défini" : $_SESSION["user-connect"]["prenom"] ?></strong>
            </div>
            <div class="info-card-profil">
                <span>Pseudo :</span>
                <strong><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["pseudo"] == null ? "Non défini" : $_SESSION["user-connect"]["pseudo"] ?></strong>
            </div>
            <div class="info-card-profil">
                <span>Email :</span>
                <strong><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["mail"] == null ? "Non défini" : $_SESSION["user-connect"]["mail"] ?></strong>
            </div>
            <div class="info-card-profil">
                <span>Mot de passe :</span>
                <strong>xxxxxxxxxxxx</strong>
            </div>
            <div class="info-card-profil">
                <span>Biographie :</span>
                <p><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["bio"] == null ? "Pas de bio défini" : $_SESSION["user-connect"]["bio"] ?></p>
            </div>
            <div class="info-card-profil">
                <span>Inscript depuis :</span>
                <p><?=isset($_SESSION['user-connect']) && $_SESSION["user-connect"]["date"] == null ? "Non défini" : $_SESSION["user-connect"]["date"] ?></p>
            </div>
            <a href="./edit-profil.php" id="btn-to-edit-profil">
                Modifier mon profil
                <i class="fas fa-edit"></i>
            </a>
        </div>
        <div class="card-from-dash">
            <div id="card-quest">
                <h1>Vos Questionnaire</h1>
            </div>
            <div id="filter-from-dash-card-quest">
                <select name="" id="">
                    <option value="null">--filtre--</option>
                    <option value="">Récent</option>
                    <option value="">Ancien</option>
                </select>
            </div>
            <div id="display-catch-data">
                <?php
                 if(isset($themeCatch) && !empty($themeCatch)){
                     for($i = 0; $i < count($themeCatch); $i++){
                         echo $themeCatch[$i]["theme"];
                         ?>
                         <div class="t-card">
                                <div class="box-number-theme-with-data">
                                    <span>Questionnaire N° &nbsp</span><strong><?= empty($themeCatch) ? "0" : $themeCatch[$i]['id_from_of_questionnaire'] ?></strong>
                                </div>
                                <div class="box-theme-with-data">
                                    <span>Theme : </span><strong><?= empty($themeCatch) ? "XXX" : $themeCatch[$i]['theme'] ?></strong>
                                </div>
                            <div class="box-descript-with-data">
                                <p><?=empty($themeCatch) ? "" : $themeCatch[$i]['description']?></p>
                            </div>
                            <a href="./votre-questionnaire.php?id_quest=<?=$themeCatch[$i]['id_from_of_questionnaire']?>" class="link-watch-plus">Voir plus</a>
                            <a href="./delete-questionnaire.php?id-quest=<?=$themeCatch[$i]['id_from_of_questionnaire']?>&iU=<?=$themeCatch[$i]['id_from_user']?>">Supprimer</a>
                            <a href="./questionnaire.php?id_quest=<?=$themeCatch[$i]['id_from_of_questionnaire']?>&iU=<?=$themeCatch[$i]['id_from_user']?>&nbP=<?=$process?>">Partager</a>
                        </div>
                    <?php
                     }
                 }else{
                     ?>
                     <div class="t-card">
                        <div class="box-theme-with-data">
                        <span>Theme : </span><strong>XXX</strong>
                    </div>
                    <div class="box-descript-with-data">
                        <p>Ici s'affiche la description de votre thème ...</p>
                    </div>
                    <a href="./votre-questionnaire.php?id_quest=" class="link-watch-plus">Lien mort</a>
                </div>
                     <?php
                 }
                ?>
            </div>
            <a href="./create-quiz.php" id="link-new-quiz-creat">Nouveau Quiz</a>
        </div>
        <div class="card-from-dash">
            <div id="card-did">
                <h1>Vous aviez participé</h1>
            </div>
            <div class="legend-theme-score">
                <strong>Thème</strong>
                <strong>Score</strong>
            </div>
            <div id="barre-bottom"></div>
            <div id="box-centent-them-score">
                <!-- php -->
                <div class="box-info-particip">
                    <strong>Le Thème</strong>
                    <strong>x / 6</strong>
                </div>
                <!-- php -->
            </div>
        </div>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";