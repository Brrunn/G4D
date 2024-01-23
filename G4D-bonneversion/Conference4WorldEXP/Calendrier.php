<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Calendrier - Conference 4 World</title>


</head>
<body>
    <section class="hero">
	<input type="checkbox" id="check">
    <header>
        <a href="accueil.php"><img src="images/LogoC4Wsfond.png" class="logo"></a>
        <div class="navigation">
            <a href="accueil.php">Accueil</a>
            <a href="conferences.php">Conférences</a>
	<a class="navactif" href="#">Calendrier</a>
            <a href="forum.php">FAQ/Forum</a>
            <a href="connexion.html">Se connecter</a>
        </div>
	<label for="check">
            <i class="fas fa-bars menu-btn"></i>
            <i class="fas fa-times close-btn"></i>
        </label>
    </header>
   <div class="content">
    <div class="info">
		<h2>Calendrier</h2>
		<p>Retrouvez ci-dessous toutes les conférences améliorées par Conferences4World.</p>
	</div>
    </div>
    <br>
    <section id="cal">
        <section id="enteteCal">
            <h1 id="calT">Janvier</h1>
            <section id="avantETaprès">
                <button id="avant" class="calbtn">◀︎</button>
                <button id="après" class="calbtn">▶︎</button>
            </section>
        </section>
	<section id="Calboîte">
	    <div id="jours">
	        <div class="jour">lun.</div>
	        <div class="jour">mar.</div>
	        <div class="jour">mer.</div>
	        <div class="jour">jeu.</div>
	        <div class="jour">ven.</div>
	        <div class="jour">sam.</div>
	        <div class="jour">dim.</div>
	    </div>
	    <div id="semaine1" class="semaine">
	        <div class="case">01</div>
	        <div class="case">02</div>
	        <div class="case">03</div>
	        <div class="case">04</div>
	        <div class="case">05</div>
	        <div class="case">06</div>
	        <div class="case">07</div>
	    </div>
	    <div id="semaine2" class="semaine">
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	    </div>
	    <div id="semaine3" class="semaine">
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	    </div>
	    <div id="semaine4" class="semaine">
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	    </div>
	    <div id="semaine5" class="semaine">
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	    </div>
	    <div id="semaine6" class="semaine">
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	        <div class="case"></div>
	    </div>
	</section>
    </section>
	<div id="overlay">
		<div id="modal">
			<span class="close">&times;</span>
    		<p>Some text in the Modal..</p>
		</div>
	</div>
	<br><br><br>
    </section>
	<footer class="footer">
        <a href="acceuil.html"><img src="images/LogoC4Wsfond.png" alt="logo"></a>
    
        <div>
            <p class="titresection">Protection des données</p>
            <a href="Politique_confidentialité.html">Politique de confidentialité</a>
            <br> 
            <a href="conditions_utilisation.html">Conditions d'utilisation</a>
        </div>
        <div>
            <p class="titresection">Nous contacter</p>
            <p><i class="fas fa-envelope"></i> louiswinkelmuller@icloud.com</p>
            <p><i class="fas fa-phone"></i> 0674870757</p>
        </div>
        <div>
            <p class="titresection">Navigation</p>
            <a href="acceuil.html">Accueil</a>
            <br> 
            <a href="connexion.html">Connexion</a>
            <br> 
            <a href="forum.html">Forum</a>
        </div>
        <div class="copyright">
            <p>&copy; 2023 | Conferences4World - Tous droits réservés</p>
        </div>
    </footer>
	<?php
		// Connexion à la base de données
		$conn = new mysqli("localhost", "root", "root", "G4D");

		// Vérification de la connexion
		if ($conn->connect_error) {
			die("Erreur de connexion : " . $conn->connect_error);
		}

		// Récupération de la date exacte d'une case du calendrier (par exemple, le 27 décembre 2023)
$year = 2023;
$month = 12;
$day = 27;

// Mettre la date au format DATETIME de MySQL
$dateFormatted = date("Y-m-d H:i:s", mktime(0, 0, 0, $month, $day, $year));

		// Requête pour récupérer les conférences du jour
$sql = "SELECT `titre`, `heure de début`, `heure de fin`, `sujet`, `salle_numéro de salle` FROM conférence WHERE `date` = \"$dateFormatted\"";
		$result = $conn->query($sql);
//		$stmt = $conn->prepare($sql);
//		$stmt->bind_param("s", $sujet);
//		$stmt->execute();
//		$result = $stmt->get_result();  
		// Vérification du nombre de résultats
		if ($result->num_rows > 0) {
			//echo '<h1 class="titre-conference">Conférences en ' . $sujet . '</h1>';
		// Affichage des détails pour chaque conférence
			while ($row = $result->fetch_assoc()) {
				//echo = '<div id="T1">';
				$t2 = '<h2 id="T2">Titre : ' . $row["titre"] . '</h2>';
				$t3 = '<p id="T3">De : ' . $row["heure de début"] . '</p>';
				$t4 = '<p id="T4">À : ' . $row["heure de fin"] . '</p>';
				$t5 = '<p id="T5">' . $row["sujet"] . '</p>';
				//echo '<p class="conference-capacite">Capacité de la salle : ' . $row["salle_capacité"] . '</p>';
				$t6 = '<p id="T6">Conférence en salle: ' . $row["salle_numéro de salle"] . '</p>';
				//echo '</div>';
				$tf = $t2."\n".$t3."\n".$t4."\n".$t5."\n".$t6;
			}
		} else {
		$tf = '<p id="T0">Pas de conférence prévue.</p>';
		}

		// Sortie de la variable PHP directement dans le script JavaScript
echo '<script>';
echo 'const phpContent = ' . json_encode($tf) . ';';
echo 'const phpday = "' . date("d/m/Y", strtotime("$year-$month-$day")) . '";';
echo '</script>';

		// Fermeture de la connexion
		$conn->close();
	?>
    <script src="script.js"></script>
</body>
</html>
