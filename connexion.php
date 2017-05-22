<?php
	include "connexionBDD.php";

	$login = $_GET['login'];
	$mdp = $_GET['mdp'];

	if ($login!=='' AND $mdp!=='') {
		$exploitantExiste = connexionExploitant($login, $mdp);

		if ($exploitantExiste==true) {
			echo "
				<meta http-equiv='refresh' content='0;url=AC11.php'>
			";
		} else {
			echo "	
				<meta http-equiv='refresh' content='0;url=index.php?
				message=<span class=\"negatif\">Les identifiants sont incorrectes</span>'>
			";
		}
	} else {
		echo "	
			<meta http-equiv='refresh' content='0;url=index.php?
			message=<span class=\"negatif\">Les champs ne peuvent être vides afin de vous connecter</span>'>
		";
	}
?>