<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="content-language" content="fr">

		<title>MESGUEN ~ AC13 ~</title>

		<link rel="icon" href="images/faviconMESGUEN.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	
	<body>
		<div class="entete">
			<?php
				include "connexionBDD.php";

				$TRNNUM = $_GET['TRNNUM'];

				$requetEID = "	SELECT max(ETPID)+1
								FROM ETAPE
								WHERE TRNNUM=$TRNNUM;";

				$resultEID = mysql_query($requetEID);

				$tableauEID = mysql_fetch_array($resultEID, MYSQL_BOTH);

				if ($tableauEID[0]=='') {
					$ETPID = 1;
				} else {
					$ETPID = $tableauEID[0];
				}

				echo "<p><b>AC13 - Organiser les tournées - Tournée $TRNNUM Etape $ETPID</b></p>";
			?>
		</div>

		<div class="contenu">
			<form action="ajoutEtape.php" method="GET">
				<table style="width: 500px; margin: auto;">
					<tr>
						<td>Lieu</td>
						<td>
							<select name="LIEUID" style="width: 151px; color: #9bbb58;">
								<?php
									$requetLIEU = "	SELECT LIEUID, LIEUNOM
													FROM LIEU;";

									$resultLIEU = mysql_query($requetLIEU);

									$capaciteLIEU = mysql_num_rows($resultLIEU);

									if ($capaciteLIEU>0) {	
										while ($tableauEID = mysql_fetch_array($resultLIEU, MYSQL_BOTH)) {		
											echo "<option value=$tableauEID[0]>$tableauEID[1]</option>";
										}
									} else {
										echo "<select size=\"1\" name=\"numero\" id=\"numero\" disabled=\"disabled\" >";	
										echo "<option>Aucun lieu disponible</option>";
									}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Rendez-vous entre</td>
						<td>
							<input name="ETPHREDEBUT" type="date" placeholder="jj/mm/aaaa hh:mm" style="width: 145px; color: #9bbb58;"/>
						</td>
					</tr>

					<tr>
						<td>et</td>
						<td>
							<input name="ETPHREFIN" type="date" placeholder="jj/mm/aaaa hh:mm" style="width: 145px; color: #9bbb58;"/>
						</td>
					</tr>

					<tr>
						<td>Pris en charge le</td>
						<td>
							<input name="" type="date" placeholder="jj/mm/aaaa hh:mm" readonly="readonly" style="width: 145px; color: #9bbb58;"/>
						</td>
					</tr>

					<tr>
						<td>Commentaire</td>
						<td>
							<textarea name="ETPCOMMENTAIRE" cols="16" rows="5" style="color: #9bbb58;"></textarea>
						</td>
					</tr>

					<tr>
						<td>
							<br/>
						</td>
					</tr>

					<tr>
						<td colspan="2" style="text-align: center;">
							<input type="hidden" name="TRNNUM" value=<?php echo "$TRNNUM"; ?>>
							<input type="hidden" name="ETPID" value=<?php echo "$ETPID"; ?>>
							<input type="submit" value="Valider"/>
							<input type="button" value="Annuler" onclick="location.href='./AC11.php'"/>
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