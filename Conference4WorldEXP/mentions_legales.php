<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "G4D");

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if (isset($_POST['delete_submit']) && isset($_POST['delete_id'])) {
    $delete_id = $conn->real_escape_string($_POST['delete_id']);

    $deleteQuery = "DELETE FROM `CGU et mentions légales` WHERE `id CGU et mentions légales` = '$delete_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: mentions_legales.php?success=1");
        exit();
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
}
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo "<script>alert('Ligne supprimée avec succès.');</script>";
}

$sql_cgu = "SELECT titre, contenu, `id CGU et mentions légales` FROM `CGU et mentions légales` WHERE type = 'mentions légales'";
$result_cgu = $conn->query($sql_cgu);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="icon" href="./images/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <title>Mentions Légales</title>
    <style>
        body {
            color: #333;
            background-color: #D9D9D9;
            margin: 0;
            padding: 20px;
            position: relative; 
        }

        h1, h2 {
            color: #FF7004;
        }

        p {
            margin-bottom: 15px;
        }

        h2 {
            margin-top: 30px;
        } 
    </style>
</head>
<body>
    <input type="checkbox" id="check">
    <header>
        <a href="accueil.php"><img src="images/LogoC4Wsfond.png" class="logo"></a>
        <div class="navigation">
            <a  href="accueil.php">Accueil</a>
            <a href="conferences.php">Conférences</a>
            <a href="forum.php">FAQ/Forum</a>
            <?php
            if (isset($_SESSION['Nom'])) {
                echo '<a href="profil.php"><i class="fa-regular fa-user"></i> ' . $_SESSION['Nom'] . '</a>';
            } else {
                echo '<a href="connexion.html"><i class="fa-regular fa-user"></i>Connexion</a>';
            }
            ?>
        </div>
        <label for="check">
            <i class="fas fa-bars menu-btn"></i>
            <i class="fas fa-times close-btn"></i>
        </label>
    </header>
    <main>
        <div class="CGU-container">
            <h1>Mentions Légales</h1>
            <p>Merci de lire attentivement les mentions légales suivantes avant d'utiliser notre service :</p>

            <?php
            if ($result_cgu->num_rows > 0) {
                while ($row_cgu = $result_cgu->fetch_assoc()) {
                    echo "<h2>" . $row_cgu['titre'] . "</h2>";
                    echo "<p>" . $row_cgu['contenu'] . "</p>";
                    //Formulaire de suppression
                    if (isset($_SESSION['id utilisateur']) && $_SESSION['type'] === "admin") {
                        echo "
                            <form method='post' class='delete-form'>
                                <input type='hidden' name='delete_id' value='" . $row_cgu['id CGU et mentions légales'] . "'>
                                <button type='submit' name='delete_submit' class='delete-btn'><i class='fas fa-trash'></i></button>
                            </form>
                        ";
                    }
                }
            } else {
                echo "Aucun contenu pour les mentions légales n'a été trouvé.";
            }

            if (isset($_SESSION['id utilisateur'])) {
                $user_id = $_SESSION['id utilisateur'];
                $sql = "SELECT type FROM utilisateur WHERE `id utilisateur` = $user_id";
                $result = $conn->query($sql);

                //Fonctionnalité ajout
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row["type"] === "admin") {
                        if (isset($_POST['submit']) && isset($_POST['new_title']) && isset($_POST['new_content'])) {
                            $new_title = $conn->real_escape_string($_POST['new_title']);
                            $new_content = $conn->real_escape_string($_POST['new_content']);

                            $insertQuery = "INSERT INTO `CGU et mentions légales` (titre, contenu, type) VALUES ('$new_title', '$new_content', 'mentions légales')";
                            if ($conn->query($insertQuery) === TRUE) {
                                header("Location: mentions_legales.php");
                                exit();
                            } else {
                                echo "Erreur lors de l'ajout du titre et contenu : " . $conn->error;
                            }
                        }

                        echo "
                            <form method='post' class='CGU-form'>
                                <h2>Bonjour " . $_SESSION['Prénom'] . ", ajoutez ici vos mentions légales: </h2>
                                <input class='CGU-titre' type='text' name='new_title' placeholder='Nouveau titre' required><br>
                                <textarea class='CGU-text' name='new_content' placeholder='Nouveau contenu' required></textarea><br>
                                <button type='submit' name='submit'>Ajouter</button>
                            </form>
                        ";
                    } else {
                        echo "Vous n'avez pas les autorisations pour accéder à cette page.";
                    }
                } else {
                    echo "Utilisateur non trouvé.";
                }
            } else {
                echo "Ces conditions d'utilisation ont été mises à jour par un administrateur.";
            }
            ?>
        </div>
    </main>
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
            <a href="accueil.php">Accueil</a>
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
