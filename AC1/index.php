<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="content-language" content="fr">

		<title>MESGUEN ~ Connexion ~</title>

		<link rel="icon" href="images/faviconMESGUEN.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	
	<body>
		<div class="entete">
			<p><b>MESGUEN - Application de suivi des tournées</b></p>
		</div>

		<div class="info">
			Connectez-vous pour accéder à l'application
		</div>

		<div class="contenu">
			<br/>
			<br/>
			<table class="formulaire">
				<tr>
					<td>
						<div class="logoMESGUEN">
							<img src="./images/logoMESGUEN.jpg" alt="L'image n'est pas disponible..."/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<form action="./connexion.php" method="get">
							<br/>
							<label>Nom d'utilisateur</label><br/>
							<input class="saisi" name="login" type="text" placeholder="Entrez le login"/><br/>
							<br/>
							<label>Mot de passe</label><br/>
							<input class="saisi" name="mdp" type="password" placeholder="Entrez le mot de passe"/><br/>
							<br/>
							<input class="boutton" type="reset" value="Effacer"/>
							<input class="boutton" type="submit" value="Connexion"/><br/>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="message">
							<?php
								if (isset($_GET['message'])) {
									echo $_GET['message'];
								} else {
									echo "&nbsp;";
								}
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="pieddepage">
			<p><b>Copyright © 2016-2017 MESGUEN</b></p>
		</div>
	</body>
</html> 