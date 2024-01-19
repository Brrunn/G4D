<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prénom'];
    $email = $_POST['e-mail'];
    $password = $_POST['MotDePasse'];
    $userType = 'élève'; // Ajout automatique du type "élève" pour les utilisateurs inscrits

    try {
        $servername = "localhost";
        $username = "root";
        $password_db = "root";
        $dbname = "G4D";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `utilisateur` (`Nom`, `Prénom`, `adresse mail`, `mot de passe`, `type`) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$Nom, $Prenom, $email, $password, $userType]);

        echo "Inscription réussie!";
        header("Location: ../Vue/accueil.php");
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

    $conn = null;
}
?>


