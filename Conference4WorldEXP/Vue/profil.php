
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/styleCO.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Conference 4 World</title>
</head>
<body>
    <div class="wrapper">
        <a href="javascript:history.go(-1)" class="back-link" ><i class="fa-solid fa-arrow-left" style="color:#000000; font-size: 24px;"></i></a>
        <img src="../images/user1.png" class="user">
        <div class="userinfo">
            <?php
            session_start();
            if (isset($_SESSION['Nom'])) {
                echo '<h2>' . $_SESSION['Prénom'] . ' ' . $_SESSION['Nom'] . '</h2>';
            } else {
                echo '<a href="../Vue/connexion.html">Se connecter</a>';
            }
            ?>
            <?php
            $conn = new mysqli("localhost", "root", "root", "G4D");

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Erreur de connexion : " . $conn->connect_error);
            }
			// Si l'utilisateur est admin ou conférencier il peut ajouter des conférences : 
			if (isset($_SESSION['id utilisateur'])) {
        			$user_id = $_SESSION['id utilisateur'];
        			$sql = "SELECT type FROM utilisateur WHERE `id utilisateur` = ?";
        			$stmt = $conn->prepare($sql);
        			$stmt->bind_param("i", $user_id);
        			$stmt->execute();
        			$result = $stmt->get_result();

        			if ($result->num_rows > 0) {
            			$row = $result->fetch_assoc();
            			if ($row["type"] === "admin" || $row["type"] === "conf") {
			?>
			<a href="#" class="btnco">Gérer mes utilisateurs</a>			
			<?php 
						}
					}
			}
			?>
            <a href="../Vue/changementmdp.html" class="btnco">Changer de Mot de Passe</a>
            <a href="../Vue/deconnexion.php" class="btnco">Se déconnecter</a>
        </div>
    </div>
</body>
