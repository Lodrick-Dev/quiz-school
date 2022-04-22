<?php
$titre_web = "Simulation - QUIZ-SCHOOL";
require_once "./function/thefunctions.php";
require_once "./treat/to-connexion.php";

require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<section id="section-quiz-simulation">
    <h1>Simulation</h1>
    <a href="<?=@$_SERVER["HTTP_REFERER"] ?>"> < Back</a>
    <a href="./dashboard.php" class="stop-cancel">Arretez la simulation</a>
    <div id="box-simulation-live">
        <form action="">
            <h2>Theme : <span>X</span></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, deserunt?</p>
            <div id="box-glob-of-div-n-input">
                <div>
                    <input type="radio" name="choice_user" id="">
                    <label for="">Réponse 1 : <span></span></label>
                </div>
                <div>
                    <input type="radio" name="choice_user" id="">
                    <label for="">Réponse 2 : <span></span></label>
                </div>
                <div>
                    <input type="radio" name="choice_user" id="">
                    <label for=""> Réponse 3 : <span></span></label>
                </div>
            </div>
            <div id="btn-to-simul-val">
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>
</section>
<?php 
require_once "./includ-global/footer.php";