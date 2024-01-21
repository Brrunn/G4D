<?php
session_start();

// Vérifiez si l'utilisateur est administrateur
if (!isset($_SESSION['id utilisateur']) || $_SESSION['type'] !== "admin") {
    // Redirigez vers une page d'erreur ou accueil.php
    header("Location: accueil.php");
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$db = 'g4d';
$user = 'root';
$password = 'root';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);

// Récupérez la section depuis les paramètres de l'URL
$section = isset($_GET['section']) ? $_GET['section'] : '';

// Vérifiez si la section est valide (vous pouvez ajouter des vérifications supplémentaires ici)
if (!in_array($section, ['section1', 'section2', 'section3', 'section4'])) {
    // Redirigez vers une page d'erreur ou accueil.php
    header("Location: accueil.php");
    exit();
}

// Supprimez le texte de la base de données pour la section spécifiée
$deleteQuery = $pdo->prepare("DELETE FROM texts WHERE section = ?");
$deleteQuery->execute([$section]);

// Redirigez vers la page d'accueil après la suppression réussie
header("Location: accueil.php");
exit();
?>
