
<?php
// Vérification si la méthode POST est utilisée pour envoyer des données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations du formulaire
    $email = $_POST["e-mail"];
    $password = $_POST["MotDePasse"];

    // Connexion à la base de données
    $serveur = 'localhost'; 
    $utilisateur_db = 'root'; 
    $mot_de_passe_db = 'root'; 
    $nom_base_de_donnees = 'G4D'; 

    try {
        // Connexion à la base de données via PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $utilisateur_db, $mot_de_passe_db);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour vérifier si l'utilisateur existe bien
        $requete = $connexion->prepare("SELECT * FROM ` utilisateur` WHERE `adresse mail` = :email AND `mot de passe` = :password");
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->execute();

        // Vérification si l'utilisateur existe bien 
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            // L'utilisateur est authentifié avec succès
            // On affiche un message de connexion 
            echo "Vous êtes connecté";
        } else {
            // Sinon on affiche un message d'erreur
            echo "Adresse e-mail ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur de connexion ou d'exécution de requête
        echo "Erreur : " . $e->getMessage();
    }
}
?>


