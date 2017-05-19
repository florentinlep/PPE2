<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="content-language" content="fr">

		<title>MESGUEN ~ AC11 ~</title>

		<link rel="icon" href="images/faviconMESGUEN.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	
	<body>
		<div class="entete">
			<p><b>AC11 - Organiser les tournées - Liste des tournées</b></p>
		</div>

		<div class="contenu">
			<table id="tableauTournee" border=1>
				<tr>
					<th>Tournée</th>
					<th>Date</th>
					<th>Chauffeur</th>
					<th>Véhicule</th>
					<th>Départ</th>
					<th>Arrivée</th>
					<th>Supprimer</th>
					<th>Modifier</th>
				</tr>
				<tr>
					<?php include "tableauTournee.php"; ?>
				</tr>
			</table>

			<br/>

			<div class="bouttonAR">
				<button onclick=document.location.href="../AC12/AC12.php">
					<img class="bouttonAJO" style="width: 17px;" src="./images/plus.PNG" alt="L'image n'est pas disponible..."/>
					<span class="bouttonAJO">
						<b>Ajouter</b>
					</span>
				</button>

				<button onclick=document.location.href="./index.php">
					<img class="bouttonRET" style="width: 20px;" src="./images/check.PNG" alt="L'image n'est pas disponible..."/>
					<span class="bouttonRET">
						<b>Retour</b>
					</span>
				</button>
			</div>

			<br/>

			<div class="message">
				<?php
					if (isset($_GET['message'])) {
						echo $_GET['message'];
					} else {
						echo "&nbsp;";
					}
				?>
			</div>
		</div>

		<div class="pieddepage">
			<p><b>Copyright © 2016-2017 MESGUEN</b></p>
		</div>
	</body>
</html> 