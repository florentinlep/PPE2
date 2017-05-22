<?php
	include "connexionBDD.php";

	$TRNNUM = str_replace("/", "", $_GET['TRNNUM']);
	$ETPID = $_GET['ETPID'];

	$requetSUE = "	DELETE FROM ETAPE
					WHERE TRNNUM = $TRNNUM
					AND ETPID = $ETPID;";

	$resultSUE = mysql_query($requetSUE);
	
	if ($resultSUE) {
		echo "
			<meta http-equiv='refresh' content='0;url=modifTournee.php?
			TRNNUM=$TRNNUM&
			message=<span class=\"positif\">La suppression s est effectuée avec succès</span>'>
		";
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=modifTournee.php?
			TRNNUM=$TRNNUM&
			message=<span class=\"negatif\">La suppression n a pas aboutit, contactez un administrateur</span>'>
		";
	}
	
?>