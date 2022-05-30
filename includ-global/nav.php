<?php
// $deco = "<a href=""><li>Déconnexion</li></a>";
?>
<header>
        <div id="box-logo-n-title">
            <a href="../">
                <img src="../file/logo/icons-g2dc4add94_640.png" alt="" srcset="">
            </a>
            <h2>QUIZ-SCHOOL</h2>
        </div>
        <nav id="box-nav">
            <ul>
                <a href="/"><li>Accueil</li></a>
                <a href="<?=isset($_SESSION['user-connect']) && !empty($_SESSION['user-connect']) ? "../dashboard.php" : "../connexion.php"?>"><li>Compte</li></a>
                <a href="../contact.php"><li>Contact</li></a>
                <?= isset($_SESSION['user-connect']) && !empty($_SESSION["user-connect"]) ? '<a href="../deconnexion.php"><li>Déconnexion</li></a>' : ""?>
            </ul>
        </nav>
        <div class="<?=isset($_SESSION['user-connect']) && !empty($_SESSION["user-connect"]) ? "connect" : "no-connect"?>"></div>
</header>