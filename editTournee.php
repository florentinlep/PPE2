<?php
	include "connexionBDD.php";

	$dateBRUT = date_create($_GET['dateTournee']);

	$date = date_format($dateBRUT, 'Y-m-d');
	$TRNNUM = str_replace("/", "", $_GET['TRNNUM']);
	$chauffeur = $_GET['chauffeur'];
	$vehicule = $_GET['vehicule'];
	$commentaire = $_GET['commentaire'];

	if ($date!=='' AND $chauffeur!=='' AND $vehicule!=='') {
		$requetTCRE = " UPDATE TOURNEE
						SET CHFID = \"$chauffeur\",
							VEHIMMAT = \"$vehicule\",
							TRNCOMMENTAIRE = \"$commentaire\",
							TRNDTE = \"$date\"
						WHERE TRNNUM = $TRNNUM;";

		$resultTCRE = executeSQL($requetTCRE);

		if ($resultTCRE) {
			echo "
				<meta http-equiv='refresh' content='0;url=AC11.php?'>
			";
		}
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=modifTournee.php?
			TRNNUM=$TRNNUM&
			message=<span class=\"negatif\">Les champs DATE, CHAUFFEUR et VEHICULE sont obligatoires</span>'>
		";
	}
?>