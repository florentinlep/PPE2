<?php
	include "AccesDonnees.php";

	$ip=explode(".",$_SERVER['SERVER_ADDR']);

	switch ($ip[0]) {
		case 127 :
		//local
			$host = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbname = "ppe2";
			$port='3306';
			break;
			
		case 31 :
		//hostinger
			$host = "mysql.hostinger.fr";
			$user = "u716363045_root";
			$password = "Florentin29200";
			$dbname = "u716363045_ppe2";
			$port='3306';
			break;
			
		default :
			exit ("Serveur non reconnu.");
			break;
	}
	
	$connexion=connexion($host,$port,$dbname,$user,$password);
	
	/*if ($connexion) {
		echo "
			<table border=1 style=\"border-collapse: collapse;\">
				<tr>
					<th colspan=2>Connexion à la base de données réussie</th>
				</tr>
				<tr>
					<td><b>Host :</b></td>
					<td>$host</td>
				</tr>
				<tr>
					<td><b>Port :</b></td>
					<td>$port</td>
				</tr>
				<tr>
					<td><b>Nom de la base :</b></td>
					<td>$dbname</td>
				</tr>
				<tr>
					<td><b>Utilisateur :</b></td>
					<td>$user</td>
				</tr>
				<tr>
					<td><b>Mot de passe :</b></td>
					<td>$password</td>
				</tr>
				<tr>
					<td><b>Mode d'accès :</b></td>
					<td>$modeacces</td>
				</tr>
			</table>
		";
	}*/
?>