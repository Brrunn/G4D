<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["e-mail"];
    $ancienMotDePasse = $_POST["AncienMotDePasse"];
    $nouveauMotDePasse = $_POST["NouveauMotDePasse"];
    $confirmNouveauMotDePasse = $_POST["ConfirmerNouveauMotDePasse"];

    // Vos informations de connexion à la base de données
    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'root'; 
    $nom_base_de_donnees = 'G4D'; 

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'ancien mot de passe est correct pour cet utilisateur
        $requete = $connexion->prepare("SELECT * FROM `utilisateur` WHERE `adresse mail` = :email AND `mot de passe` = :password");
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $ancienMotDePasse);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            // Mettre à jour le mot de passe
            $updateMotDePasse = $connexion->prepare("UPDATE `utilisateur` SET `mot de passe` = :nouveauMotDePasse WHERE `adresse mail` = :email");
            $updateMotDePasse->bindParam(':nouveauMotDePasse', $nouveauMotDePasse);
            $updateMotDePasse->bindParam(':email', $email);
            $updateMotDePasse->execute();
        
            // Afficher une notification et rediriger vers la page d'accueil
            echo '<script>alert("Mot de passe modifié avec succès."); window.location.href = "accueil.php";</script>';
        } else {
            echo '<script>alert("L\'ancien mot de passe est incorrect."); history.back();</script>';
        }
        
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
