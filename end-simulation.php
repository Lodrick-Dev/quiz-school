<?php
$titre_web = "Fin de la simulation - QUIZ-SCHOOL";
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-end-simulation">
    <h1>Résultat de la simulation</h1>
    <div id="box-card-end-to-simulation">
        <h2>Bravo ! Simulation de quiz terminé</h2>
        <div id="box-card-to-them-simulation">
            <h3>Theme : <strong>History</strong></h3>
        </div>
        <div id="box-card-to-score-simulation">
            <div>
                <h3>Score : <strong>5</strong><span>/</span> <strong>6</strong></h3>
            </div>
        </div>
        <div id="box-card-to-img-profil">
            <img src="./file/avatardefault/bear-gf5600b6ed_1920.png" alt="" srcset="">
            <a href="./edit-questionnaire.php">Corriger une erreur ?</a>
        </div>
        <a href="./dashboard.php"> < Revenir au dashboard</a>
    </div>
</section>
<?php
require_once "./includ-global/footer.php";