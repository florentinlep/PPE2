<?php
	include "connexionBDD.php";

	$TRNNUM = $_GET['TRNNUM'];

	$requetSUE = "	DELETE
					FROM ETAPE
					WHERE TRNNUM = $TRNNUM;";

	$resultSUE = mysql_query($requetSUE);
	
	$requetSUT = "	DELETE
					FROM TOURNEE
					WHERE TRNNUM = $TRNNUM;";
	
	$resultSUT = mysql_query($requetSUT);
	
	if ($resultSUT) {
		echo "
			<meta http-equiv='refresh' content='0;url=AC11.php?
			message=<span class=\"positif\">La suppression s est effectuée avec succès.</span>'>
		";
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=AC11.php?
			message=<span class=\"negatif\">La suppression n a pas aboutit, contactez un administrateur.</span>'>
		";
	}
?>