<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["e-mail"];
    $password = $_POST["MotDePasse"];

    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'root'; 
    $nom_base_de_donnees = 'G4D'; 

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $connexion->prepare("SELECT * FROM `utilisateur` WHERE `adresse mail` = :email AND `mot de passe` = :password");
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            //On récupère les informations de l'utilisateur pour la suite...
            $_SESSION['id utilisateur'] = $resultat['id utilisateur'];
            $_SESSION['Nom'] = $resultat['Nom'];
            $_SESSION['Prénom'] = $resultat['Prénom'];
            $_SESSION['type'] = $resultat['type'];
            header("Location: ../Vue/accueil.php");
            exit();
        } else {
            echo "Adresse e-mail ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>



