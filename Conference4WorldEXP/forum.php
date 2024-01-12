<?php
    session_start();

    // Connexion à la base de données (à compléter avec vos informations de connexion)
    $conn = new mysqli("localhost", "root", "root", "G4D");

    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Traitement du formulaire pour ajouter une nouvelle question et réponse
    if (isset($_POST['newQuestion']) && isset($_POST['newAnswer'])) {
        // Assurez-vous de nettoyer les données d'entrée pour éviter les injections SQL
        $newQuestion = $conn->real_escape_string($_POST['newQuestion']);
        $newAnswer = $conn->real_escape_string($_POST['newAnswer']);

        // Requête d'insertion dans la base de données
        $insertQuery = "INSERT INTO `question de FAQ` (`réponse proposée`, `question proposée`) VALUES ('$newAnswer', '$newQuestion')";
        if ($conn->query($insertQuery) === TRUE) {
            // Redirection vers la page de la FAQ après l'ajout réussi
            header("Location: forum.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la question : " . $conn->error;
        }
    }

    // Récupération des questions et réponses depuis la base de données
    $sql_select = "SELECT `question proposée`, `réponse proposée` FROM `question de FAQ`";
    $result_select = $conn->query($sql_select);
?>
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
                <a href="accueil.php">Accueil</a>
                <a href="conferences.php">Conférences</a>
                <a class="navactif" href="forum.php">FAQ/Forum</a>
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
        <div class="FAQwrapper slide-up">
            <h1>Vos questions les plus fréquentes (FAQ)</h1>
            <div class="faq">
                <button class="question">
                    Comment puis-je garantir une qualité audio optimale pendant une conférence ?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="reponse">
                    <p>
                        Pour une qualité audio optimale, plusieurs éléments sont cruciaux. D'abord, assurez-vous d'avoir un environnement calme, éloigné des bruits de fond ou des distractions potentielles. Utilisez des microphones de qualité adaptés à votre espace et au nombre de participants, privilégiant ceux avec réduction de bruit ou directionnels pour limiter les sons indésirables. Testez vos équipements audio avant la conférence pour ajuster les niveaux, éviter la distorsion ou les échos. Enfin, durant la conférence, surveillez régulièrement les niveaux audio et encouragez les participants à utiliser des écouteurs pour réduire les risques de rétroaction.
                    </p>
                </div>
    
            </div>
            <div class="faq">
                <button class="question">
                    Quand sont organisés les sondages sur le fonctionnement des conférences audio ?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="reponse">
                    <p>
                        Les sondages concernant le fonctionnement des conférences audio sont généralement programmés pendant la pause de la session. Vous serez averti de la disponibilité de ces sondages par le biais d'une notification directement sur le site. Ils offrent une opportunité précieuse pour recueillir vos retours, avis et suggestions sur les aspects audio de la conférence. Votre participation active à ces sondages contribue à améliorer continuellement la qualité de nos conférences en identifiant les points à améliorer et en répondant aux besoins spécifiques de notre communauté.
                    </p>
                </div>
    
            </div>
            <div class="faq">
                <button class="question">
                    Comment résoudre les problèmes de rétroaction audio lors d'une présentation ?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="reponse">
                    <p>
                        La rétroaction audio, souvent identifiée par des bruits stridents et désagréables, est généralement causée par une boucle de rétroaction entre les haut-parleurs et les microphones. Pour l'éviter, assurez-vous que les haut-parleurs ne sont pas positionnés trop près des microphones pour réduire les risques de capture du son émis. Utilisez des équipements anti-larsen ou des logiciels de suppression de bruit pour atténuer ces problèmes. Avant toute présentation, testez rigoureusement le matériel audio pour détecter et corriger ces problèmes potentiels.
                    </p>
                </div>
            </div>
            <?php
                // Récupération des questions et réponses depuis la base de données
                $sql_select = "SELECT `question proposée`, `réponse proposée` FROM `question de FAQ`";
                $result_select = $conn->query($sql_select);

                if ($result_select->num_rows > 0) {
                    while ($row_select = $result_select->fetch_assoc()) {
                    // Structure HTML pour afficher chaque question et réponse
            ?>
            <div class="faq">
                <button class="question">
                    <?php echo $row_select['question proposée']; ?>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="reponse">
                    <p>
                        <?php echo $row_select['réponse proposée']; ?>
                    </p>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <?php
            // Vérifier si l'utilisateur est administrateur pour afficher le formulaire d'ajout de questions/réponses
            if (isset($_SESSION['id utilisateur'])) {
                $user_id = $_SESSION['id utilisateur'];
                $sql = "SELECT type FROM utilisateur WHERE `id utilisateur` = $user_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row["type"] === "admin") {
            ?>
                <form id="addQuestionForm" method="post">
                <input type="text" name="newQuestion" id="newQuestion" placeholder="Nouvelle question" required>
                <textarea name="newAnswer" id="newAnswer" placeholder="Réponse" required></textarea>
                <button type="submit">Ajouter</button>
                </form>
                <?php
                    }
                }
            }
        ?>
         </div>
    </section>
    <script src="script.js"></script>
    <footer class="footer">
        <a href="accueil.php"><img src="images/LogoC4Wsfond.png" alt="logo"></a>
    
        <div>
            <p class="titresection">Protection des données</p>
            <a href="mentions_legales.php">Mentions légales</a>
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

