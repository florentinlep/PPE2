<?php
	include 'connexionBDD.php';
	
	// On récupère l'ID, la date, le nom du chauffeur et l'immatriculation
	// On créer un tableau contenant les informations
	$requetTOURNEE = "	SELECT tourneeID, DATE_FORMAT(tourneeDAT, '%d/%c/%Y') AS tourneeDAT, chauffeurNOM, vehiculeIMM 
						FROM TOURNEE, CHAUFFEUR 
						WHERE TOURNEE.chauffeurID = CHAUFFEUR.chauffeurID;";

	$resultTOURNEE = mysql_query($requetTOURNEE);
	
	if($resultTOURNEE) {
		while ($rowTOURNEE = mysql_fetch_array($resultTOURNEE, MYSQL_BOTH)) {
			echo "
				<tr>
					<td>".$rowTOURNEE['tourneeID']."</td>
					<td class=\"tableauDAT\">".$rowTOURNEE['tourneeDAT']."</td>
					<td>".$rowTOURNEE['chauffeurNOM']."</td>
					<td>".$rowTOURNEE['vehiculeIMM']."</td>
			";

			$tourneeID = $rowTOURNEE['tourneeID'];
	
			// On récupère le lieu de départ
			// On l'insère dans le tableau contenant les informations
			$requetDEPART = "	SELECT lieuNOM
								FROM LIEU,ETAPE
								WHERE ETAPE.lieuID = LIEU.lieuID
								AND ETAPE.tourneeID = ".$tourneeID."
								ORDER BY etapeHRD ASC;";

			$resultDEPART = mysql_query($requetDEPART);

			$tableauDEPART = mysql_fetch_array($resultDEPART,MYSQL_BOTH);

			echo "
				<td>".$tableauDEPART[0]."</td>
			";

			// On récupère le lieu de fin
			// On l'insère dans le tableau contenant les informations
			$requetFIN = "	SELECT lieuNOM
							FROM LIEU,ETAPE
							WHERE ETAPE.lieuID = LIEU.lieuID
							AND ETAPE.tourneeID = ".$tourneeID."
							ORDER BY etapeHRD DESC;";

			$resultFIN = mysql_query($requetFIN);

			$tableauFIN = mysql_fetch_array($resultFIN,MYSQL_BOTH);

			echo "
					<td>".$tableauFIN[0]."</td>";
			
			// On regarde si la tournee est commencé
			// On affiche l'image correspondante en sortit
			$requetPEC = "	SELECT tourneePEC
							FROM TOURNEE
							WHERE tourneeID = ".$tourneeID.";";

			$resultPEC = mysql_query($requetPEC);

			$tableauPEC = mysql_fetch_array($resultPEC,MYSQL_BOTH);

			if ($tableauPEC[0]=="Oui") {
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
							<input class=\"tourneeID\" id=\"tourneeID\" name=\"tourneeID\" type=\"hidden\" value=\"".$tourneeID."\"/>
							<input class=\"bouttonSUP\" type=\"image\" src=\"./images/croix.PNG\"/>
						</form>
					</td>
				";
			}
			
			echo "
					<td class=\"bouttonTAB\"> 
						<form action=\"\" method=\"get\">
							<input class=\"tourneeID\" id=\"tourneeID\" name=\"tourneeID\" type=\"hidden\" value=\"".$tourneeID."\"/>
							<input class=\"bouttonMOD\" type=\"image\" src=\"./images/modifier.PNG\"/>
						</form> 
					</td>
				</tr>
			";
		}
	}
?>