<?php
	include "connexionBDD.php";

	$TRNNUM = str_replace("/", "", $_GET['TRNNUM']);
	$ETPID = $_GET['ETPID'];
	$LIEUID = $_GET['LIEUID'];
	$ETPHREDEBUT = $_GET['ETPHREDEBUT'];
	$ETPHREFIN = $_GET['ETPHREFIN'];
	$ETPCOMMENTAIRE = $_GET['ETPCOMMENTAIRE'];

	if ($ETPHREDEBUT!=='' AND $ETPHREFIN!=='') {
		$requetEEDI = " UPDATE ETAPE
						SET LIEUID = \"$LIEUID\",
							ETPHREDEBUT = \"$ETPHREDEBUT\",
							ETPHREFIN = \"$ETPHREFIN\",
							ETPCOMMENTAIRE = \"$ETPCOMMENTAIRE\"
						WHERE TRNNUM = '$TRNNUM'
						AND ETPID = '$ETPID';";

		$resultEEDI = executeSQL($requetEEDI);

		if ($resultEEDI) {
			echo "
				<meta http-equiv='refresh' content='0;url=modifTournee.php?
				TRNNUM=$TRNNUM&
				message=<span class=\"positif\">Modification effectuée</span>'>
			";
		}
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=modifTournee.php?
			TRNNUM=$TRNNUM&
			message=<span class=\"negatif\">Les champs DEBUT et FIN sont obligatoires</span>'>
		";
	}
?>