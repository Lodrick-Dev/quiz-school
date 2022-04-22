<?php
$titre_web = "Votre questionnaire - QUIZ-SCHOOL";

require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="display-questionnary">
    <h1>Votre questionnaire</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <div id="box-questionnary-display">
        <!-- php -->
        <div class="box-boucl">
            <h2>Theme : </h2>
            <div class="box-quest">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt ratione unde rerum praesentium fuga commodi modi reprehenderit. Iure, quod maxime.</p>
                <div class="answer">
                    <span>R - 1</span>
                    <span>R - 2</span>
                    <span>R - 3</span>
                </div>
            </div>
        </div>
        <!-- php -->
        <div id="box-link-on-simul">
            <a href="./quiz-simulation.php">Faire une simulation</a>
            <a href="./edit-questionnaire.php">Modifier le questionnaire</a>
        </div>
    </div>
</section>
<?php
    require_once "./includ-global/footer.php";