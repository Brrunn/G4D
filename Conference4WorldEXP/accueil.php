<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Conference 4 World</title>
</head>
<body>
    <section class="hero">
        <input type="checkbox" id="check">
        <header>
            <a href="accueil.php"><img src="images/LogoC4Wsfond.png" class="logo"></a>
            <div class="navigation">
                <a class="navactif" href="accueil.php">Accueil</a>
                <a href="conferences.php">Conférences</a>
                <a href="forum.php">FAQ/Forum</a>
                <?php
                session_start();
                if (isset($_SESSION['Nom'])) {
                    echo '<a href="profil.php"><i class="fa-regular fa-user"></i> ' . $_SESSION['Nom'] . '</a>';
                } else {
                    echo '<a href="connexion.html" class="connexion-header"><i class="fa-regular fa-user"></i>Connexion</a>';
                }
                ?>
            </div>
            <label for="check">
                <i class="fas fa-bars menu-btn"></i>
                <i class="fas fa-times close-btn"></i>
            </label>
        </header>
        <div class="content">
            <div class="info slide-up">
                <h2>Laissez-Vous Accompagner Dans La Gestion De Conférences.</h2>
                <p>Nous proposons un service de gestion de conférences avec des capteurs haute de gamme et un suivi avec de nombreuses fonctionnalités.</p>
                <a href="connexion.html" class="CoBouton">Se connecter</a>
            </div>
        </div>
    </section>
    <section class="demo">
        <div class="content-demo">
            <div class="image slide-up">
                <img src="images/Image2.png" class="imagedemo">
            </div>
            <div class="text slide-up">
                <h2>Soyez sûr que chaque mot compte.</h2>
                <p>Optimisez l'expérience audio de vos conférences avec nos capteurs sonores de pointe pour une gestion de qualité inégalée.</p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
    
   <footer class="footer">
        <a href="accueil.php"><img src="images/LogoC4Wsfond.png" alt="logo"></a>
    
        <div>
            <p class="titresection">Protection des données</p>
            <a href="mentions_legales.php">Mentions Légales</a>
            <br> 
            <a href="conditions_utilisation.php">Conditions Générales d'Utilisation</a>
        </div>
        <div>
            <p class="titresection">Nous contacter</p>
            <p><i class="fas fa-envelope"></i> louiswinkelmuller@icloud.com</p>
            <p><i class="fas fa-phone"></i> 0674870757</p>
        </div>
        <div>
            <p class="titresection">Navigation</p>
            <a href="acceuil.php">Accueil</a>
            <br> 
            <a href="connexion.html">Connexion</a>
            <br> 
            <a href="forum.php">Forum</a>
        </div>
        <div class="copyright">
            <p>&copy; 2023 | Conferences4World - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>
