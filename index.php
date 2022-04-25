<?php
session_start();
$titre_web = "QUIZ-SCHOOLL - Accueil";
session_destroy();
require_once "./includ-global/head.php";
require_once "./includ-global/nav.php";
?>
<main>
    <div>
        <h2>Lorem Boum</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus</p>
        <img id="img-first" src="./file/home/brainstorm-g1d89aa705_1280.jpg" alt="" srcset="">
    </div>
    <div>
    <h2>Lorem Boum</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus</p>
        <img src="./file/home/quiz-g67c503a94_1280.png" alt="" srcset="">
    </div>
    <div>
    <h2>Lorem Boum</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus</p>
        <img src="./file/home/quiz-ged38fbc74_1280.png" alt="" srcset="">
    </div>
    <div>
    <h2>Lorem Boum</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus</p>
        <img src="./file/home/rocket-gdda4fbe32_1280.png" alt="" srcset="">
    </div>
</main>
<?php
    require_once "./includ-global/footer.php";