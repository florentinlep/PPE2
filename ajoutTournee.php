<?php
	include "connexionBDD.php";

	$dateBRUT = date_create($_GET['dateTournee']);

	$date = date_format($dateBRUT, 'Y-m-d');
	$TRNNUM = $_GET['TRNNUM'];
	$chauffeur = $_GET['chauffeur'];
	$vehicule = $_GET['vehicule'];
	$commentaire = $_GET['commentaire'];

	if ($date!=='' AND $chauffeur!=='' AND $vehicule!=='') {
		$requetTCRE = "	INSERT INTO TOURNEE(TRNNUM, CHFID, VEHIMMAT, TRNCOMMENTAIRE, TRNDTE) 
						VALUES ($TRNNUM, $chauffeur, \"$vehicule\", \"$commentaire\", \"$date\");";

		$resultTCRE = executeSQL($requetTCRE);

		if ($resultTCRE) {
			echo "	
				<meta http-equiv='refresh' content='0;url=nouvelleEtape.php?
				TRNNUM=$TRNNUM'>
			";
		}
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=nouvelleTournee.php?
			message=<span class=\"negatif\">Les champs DATE, CHAUFFEUR et VEHICULE sont obligatoires</span>'>
		";
	}
?>