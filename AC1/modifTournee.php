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

				$TRNNUM = $_GET['TRNNUM'];

				echo "<p><b>AC12 - Organiser les tournées - Tournée $TRNNUM</b></p>"; 
			?>
		</div>

		<div class="contenu">
			<form action="./editTournee.php" method="GET">
				<?php
					$requetTOURNEE = "	SELECT TRNDTE, CHFID, VEHIMMAT, TRNCOMMENTAIRE
										FROM TOURNEE
										WHERE TRNNUM=$TRNNUM;";

					$resultTOURNEE = mysql_query($requetTOURNEE);

					$tableauTOURNEE = mysql_fetch_array($resultTOURNEE, MYSQL_BOTH);
				?>
				<table class="tableauGauche">
					<tr>
						<td>Date</td>
						<td>
							<input type="date" name="dateTournee" placeholder="jj/mm/aaaa" value=<?php echo "$tableauTOURNEE[0]"; ?> style="width: 145px; color: #9bbb58;"/>
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
							<textarea name="commentaire" cols="16" rows="5" style="color: #9bbb58;"><?php echo "$tableauTOURNEE[3]"; ?></textarea>
						</td>
					</tr>

					<tr>
						<td>
							<br/>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="TRNNUM" value=<?php echo "$TRNNUM" ?>/>
							<input
								id="Valider"
								name="Valider"
								type="submit"
								value="Valider"
										
								<?php
									$sql = "SELECT * 
											FROM etape
											WHERE TRNNUM=$TRNNUM;";
									$result1 = mysql_query($sql);
									$cpt=mysql_num_rows($result1);
									
									if ($cpt==0){
										echo("disabled=\"disabled\"");
									}
								?>
							/>
							<input type="button" value="Annuler" onclick="location.href='./AC11.php'"/>
						</td>
					</tr>
				</table>
			</form>
				<table class="tableauDroite">
					<tr>
						<td></td>
						<td>Etapes</td>
						<td></td>
						<td></td>
					</tr>

					<?php							
						//selection id de la ville 
						$sql = "SELECT LIEUID 
								FROM ETAPE 
								WHERE TRNNUM = $TRNNUM;";

						$result = executeSQL($sql);

						$VILID = mysql_fetch_row($result);
						
						
						//cherche la ville avec l'id
						$sql = "SELECT LIEUID, LIEUNOM 
								FROM LIEU 
								WHERE LIEUID = $VILID[0];";

						$cpt = compteSQL($sql);
						
						if ($cpt>0) {	
							while ($row = mysql_fetch_array($result1, MYSQL_BOTH)) {
								echo "
									<tr>
										<td>$row[1]</td>
										<td>$row[2]</td>
										<td>
											<form action=\"supprimeEtape.php\" method=\"get\">
												<input name=\"TRNNUM\" type=\"hidden\" value=\"$TRNNUM\"/>
												<input name=\"ETPID\" type=\"hidden\" value=\"$row[1]\"/>
												<input class=\"bouttonSUP\" type=\"image\" src=\"./images/croix.PNG\"/>
											</form>
										</td>
										<td>
											<form action=\"modifEtape.php\" method=\"get\">
												<input name=\"TRNNUM\" type=\"hidden\" value=\"$TRNNUM\"/>
												<input name=\"ETPID\" type=\"hidden\" value=\"$row[1]\"/>
												<input class=\"bouttonMOD\" type=\"image\" src=\"./images/modifier.PNG\"/>
											</form> 
										</td>
									</tr>
								";
									
							}					
						} else {
							echo "<p>Aucune etape en cour...</p>";
						}         
		    		?>

		    		<tr>
		    			<td>
		    				<br/>
		    			</td>
		    		</tr>

					<tr>
						<td></td>
						<td></td>
						<td colspan="2">
							<form action="nouvelleEtape.php" method="GET">
								<input type="hidden" name="TRNNUM" value=<?php echo "$TRNNUM"; ?>>
								<input type="submit" name="ajouter" value="Ajouter" style="width: 100px;">
							</form>
						</td>
					</tr>
				</table>
			

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