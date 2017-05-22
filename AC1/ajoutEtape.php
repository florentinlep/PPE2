<?php
	include "connexionBDD.php";

	$dateDEBRUT = date_create($_GET['ETPHREDEBUT']);
	$dateFIBRUT = date_create($_GET['ETPHREFIN']);

	$ETPHREDEBUT = date_format($dateDEBRUT, 'Y-m-d H:m');
	$ETPHREFIN = date_format($dateFIBRUT, 'Y-m-d H:m');

	$TRNNUM = $_GET['TRNNUM'];
	$ETPID = $_GET['ETPID'];
	$LIEUID = $_GET['LIEUID'];
	$ETPCOMMENTAIRE = $_GET['ETPCOMMENTAIRE'];

	if ($LIEUID!=='' AND $ETPHREDEBUT!=='' AND $ETPHREFIN!=='') {
		$requetECRE = "	INSERT INTO etape(TRNNUM, ETPID, LIEUID, ETPHREMIN, ETPHREMAX, ETPHREDEBUT, ETPHREFIN, ETPNBPALLIV, 										  ETPNBPALLIVEUR, ETPNBPALCHARG, ETPNBPALCHARGEUR, ETPCHEQUE, ETPETATLIV, ETPCOMMENTAIRE, ETPVAL, 						ETPKM)
						VALUES ($TRNNUM, $ETPID, $LIEUID, NULL, NULL, \"$ETPHREDEBUT\", \"$ETPHREFIN\", NULL, NULL, NULL, NULL, NULL, NULL    , \"$ETPCOMMENTAIRE\", NULL, NULL);";

		$resultECRE = executeSQL($requetECRE);

		if ($resultECRE) {
			echo "	
				<meta http-equiv='refresh' content='0;url=modifTournee.php?
				TRNNUM=$TRNNUM'>
			";
		}
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=nouvelleEtape.php?
			TRNNUM=$TRNNUM&
			ETPID=$ETPID&
			message=<span class=\"negatif\">Les champs LIEUID, ETPHREDEBUT et ETPHREFIN sont obligatoires</span>'>
		";
	}
?>