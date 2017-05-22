<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="content-language" content="fr">

		<title>MESGUEN ~ AC12 ~</title>

		<link rel="icon" href="images/faviconMESGUEN.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	
	<body>
		<div class="entete">
			<?php
				include "connexionBDD.php";

				$requetTID = "	SELECT max(TRNNUM)+1
								FROM TOURNEE;";

				$resultTID = mysql_query($requetTID);

				$tableauTID = mysql_fetch_array($resultTID, MYSQL_BOTH);

				$TRNNUM = $tableauTID[0];

				echo "<p><b>AC12 - Organiser les tournées - Tournée $TRNNUM</b></p>"; 
			?>
		</div>

		<div class="contenu">
			<form action="./ajoutTournee.php" method="GET">
				<table class="tableauGauche">
					<tr>
						<td>Date</td>
						<td>
							<input type="date" name="dateTournee" placeholder="jj/mm/aaaa" style="width: 145px; color: #9bbb58;"/>
						</td>
					</tr>

					<tr>
						<td>Chauffeur</td>
						<td>
							<?php
								$requetCHAUFFEUR = "SELECT CHFID, CHFNOM 
													FROM CHAUFFEUR";

								$resultCHAUFFEUR = mysql_query($requetCHAUFFEUR);

								$capaciteCHAUFFEUR = mysql_num_rows($resultCHAUFFEUR);

								if ($capaciteCHAUFFEUR>0) {
									echo "<select size=\"1\" name=\"chauffeur\" id=\"numero\" style=\"width: 151px; color: #9bbb58;\">";
									
									while ($row = mysql_fetch_array($resultCHAUFFEUR, MYSQL_BOTH)) {
										echo "<option value=$row[0]>$row[1]</option>";
									}

								} else {
									echo "<select size=\"1\" name=\"chauffeur\" id=\"chauffeur\" disabled=\"disabled\">";
									echo "<option>Aucune information</option>";
								}

								echo "</select>";
							?>
						</td>
					</tr>

					<tr>
						<td>Véhicule</td>
						<td>
							<?php
								$requetVEHICULE = "	SELECT VEHIMMAT
													FROM VEHICULE";

								$resultVEHICULE = mysql_query($requetVEHICULE);
								
								$capaciteVEHICULE = mysql_num_rows($resultVEHICULE);
								
								if ($capaciteVEHICULE>0) {
									echo "<select size=\"1\" name=\"vehicule\" id=\"vehicule\" style=\"width: 151px; color: #9bbb58;\">";	
									
									while ($row = mysql_fetch_array($resultVEHICULE, MYSQL_BOTH)) {
										echo "<option value=$row[0]>$row[0]</option>";
									}

								} else {
									echo "<select size=\"1\" name=\"vehicule\" id=\"vehicule\" disabled=\"disabled\" >";	
									echo "<option>Aucune information</option>";
								}
							
								echo "</select>";
							?>
						</td>
					</tr>

					<tr>
						<td>Pris en charge le</td>
						<td>
							<input type="date" name="datePEC" placeholder="j/m/aa h:mm" readonly="readonly" style="width: 145px; color: #9bbb58;"/>
						</td>
					</tr>

					<tr>
						<td>Commentaire</td>
						<td>
							<textarea name="commentaire" cols="16" rows="5" style="color: #9bbb58;"></textarea>
						</td>
					</tr>

					<tr>
						<td>
							<br/>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="button" value="Ajouter" disabled="disabled"/>
							<input type="button" value="Annuler" onclick="location.href='./AC11.php'"/>
						</td>
					</tr>
				</table>

				<table class="tableauDroite">
					<tr>
						<td></td>
						<td>Etapes</td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td style="color: #9bbb58;">></td>
						<td style="color: #9bbb58;">Pas d'étape dans la tournée</td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td colspan="2">
							<input type="hidden" name="TRNNUM" value=<?php echo "$TRNNUM"; ?>>
							<input type="submit" name="ajouter" value="Ajouter" style="width: 100px;">
						</td>
					</tr>
				</table>
			</form>

			<table>
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