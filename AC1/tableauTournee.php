<?php
	include 'connexionBDD.php';
	
	// On récupère l'ID, la date, le nom du chauffeur et l'immatriculation
	// On créer un tableau contenant les informations
	$requetTOURNEE = "	SELECT TRNNUM, DATE_FORMAT(TRNDTE, '%d/%c/%Y') AS TRNDTE, CHFNOM, VEHIMMAT 
						FROM TOURNEE, CHAUFFEUR 
						WHERE TOURNEE.CHFID = CHAUFFEUR.CHFID;";

	$resultTOURNEE = mysql_query($requetTOURNEE);
	
	if($resultTOURNEE) {
		while ($rowTOURNEE = mysql_fetch_array($resultTOURNEE, MYSQL_BOTH)) {
			echo "
				<tr>
					<td>".$rowTOURNEE['TRNNUM']."</td>
					<td class=\"tableauDAT\">".$rowTOURNEE['TRNDTE']."</td>
					<td>".$rowTOURNEE['CHFNOM']."</td>
					<td>".$rowTOURNEE['VEHIMMAT']."</td>
			";

			$TRNNUM = $rowTOURNEE['TRNNUM'];
	
			// On récupère le lieu de départ
			// On l'insère dans le tableau contenant les informations
			$requetDEPART = "	SELECT LIEUNOM
								FROM LIEU, ETAPE
								WHERE ETAPE.LIEUID = LIEU.LIEUID
								AND ETAPE.TRNNUM = ".$TRNNUM."
								ORDER BY ETPHREDEBUT ASC;";

			$resultDEPART = mysql_query($requetDEPART);

			$tableauDEPART = mysql_fetch_array($resultDEPART,MYSQL_BOTH);

			echo "
				<td>".$tableauDEPART[0]."</td>
			";

			// On récupère le lieu de fin
			// On l'insère dans le tableau contenant les informations
			$requetFIN = "	SELECT LIEUNOM
							FROM LIEU, ETAPE
							WHERE ETAPE.LIEUID = LIEU.LIEUID
							AND ETAPE.TRNNUM = ".$TRNNUM."
							ORDER BY ETPHREDEBUT DESC;";

			$resultFIN = mysql_query($requetFIN);

			$tableauFIN = mysql_fetch_array($resultFIN,MYSQL_BOTH);

			echo "
					<td>".$tableauFIN[0]."</td>";
			
			// On regarde si la tournee est commencé
			// On affiche l'image correspondante en sortit
			/*$requetPEC = "	SELECT tourneePEC
							FROM TOURNEE
							WHERE TRNNUM = ".$TRNNUM.";";

			$resultPEC = mysql_query($requetPEC);

			$tableauPEC = mysql_fetch_array($resultPEC,MYSQL_BOTH);

			if ($tableauPEC[0]!==NULL) {
				echo "
					<td class=\"bouttonTAB\">
						<form>
							<input class=\"bouttonTAG\" type=\"image\" src=\"./images/croixG.png\" disabled=\"disabled\"/>
						</form>
					</td>
				";
			} else {
				echo "
					<td class=\"bouttonTAB\">
						<form action=\"supprimeTournee.php\" method=\"get\">
							<input class=\"TRNNUM\" id=\"TRNNUM\" name=\"TRNNUM\" type=\"hidden\" value=\"".$TRNNUM."\"/>
							<input class=\"bouttonSUP\" type=\"image\" src=\"./images/croix.PNG\"/>
						</form>
					</td>
				";
			}*/

			echo "
				<td class=\"bouttonTAB\">
					<form action=\"supprimeTournee.php\" method=\"get\">
						<input class=\"TRNNUM\" id=\"TRNNUM\" name=\"TRNNUM\" type=\"hidden\" value=\"".$TRNNUM."\"/>
						<input class=\"bouttonSUP\" type=\"image\" src=\"./images/croix.PNG\"/>
					</form>
				</td>
			";
			
			echo "
					<td class=\"bouttonTAB\"> 
						<form action=\"modifTournee.php\" method=\"get\">
							<input class=\"TRNNUM\" id=\"TRNNUM\" name=\"TRNNUM\" type=\"hidden\" value=\"".$TRNNUM."\"/>
							<input class=\"bouttonMOD\" type=\"image\" src=\"./images/modifier.PNG\"/>
						</form> 
					</td>
				</tr>
			";
		}
	}
?>