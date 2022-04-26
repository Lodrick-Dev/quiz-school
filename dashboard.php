<?php
session_start();
if(!isset($_SESSION['user-connect'])){
    header("Location: ./connexion.php");
}
$titre_web = "Dashboard - QUIZ-SCHOOL";

require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
var_dump($_SESSION['user-connect']);

?>
<section id="section-dashboard">
    <h1>TABLEAU DE BORD</h1>
    <div id="box-card-from-dash">
        <div class="card-from-dash">
            <div id="card-profil-from-dash">
                <h1>Votre profil</h1>
            </div>
            <div class="info-card-profil">
                <img src="./file/avatardefault/bear-gf5600b6ed_1920.png" alt="" srcset="">
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
                <!-- php -->
                <div class="t-card">
                    <div class="box-theme-with-data">
                        <span>Theme : </span><strong>X</strong>
                    </div>
                    <div class="box-descript-with-data">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus, culpa.</p>
                    </div>
                    <a href="./votre-questionnaire.php" class="link-watch-plus">Voir plus</a>
                </div>
                <!-- php -->
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