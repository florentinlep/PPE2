<?php
	//////////////////////////////////////////////////////////////////////
	//	Banque de fonctions PHP permettant la manipulation de données	//
	//	sur une base MySQL.												//
	//	Créé par LEPREVOST Florentin									//
	//	Version 1.0														//
	//	7 fonctions :	- connexion 									//
	//					- deconnexion									//
	//					- executeSQL									//
	//					- compteSQL										//
	//					- tableSQL										//
	//					- champSQL										//
	//					- nombrechamp									//
	//					- connexionExploitant							//
	//////////////////////////////////////////////////////////////////////

	//////////////// CONFIGURATION DE L'ACCES AUX DONNEES ////////////////
	// nom du moteur d'accès à la base : mysql - mysqli 				//
	$modeacces = "mysql";												//
	//////////////////////////////////////////////////////////////////////

	// Fonction permettant de se connecter à une base de données
	// Retourne la connexion
	function connexion($host,$port,$dbname,$user,$password) {
		global $modeacces, $connexion;
		
		if ($modeacces=="mysql") {
			@$link = mysql_connect("$host:$port", "$user", "$password");
			
			if (!$link) {
				$chaine = "Connexion PB - ".date("j M Y - G:i:s - ").$user." - ". mysql_error()."\r\n";	
			} else {
				@$connexion = mysql_select_db("$dbname");

				if (!$connexion) {
					$chaine = "Selection base PB - ".date("j M Y - G:i:s - ").$user." - ". mysql_error()."\r\n";
				} else {
					$chaine = "Connexion OK - ".date("j M Y - G:i:s - ").$user."\r\n";
				}
			}

			return $connexion;
		}

		if ($modeacces=="mysqli") {
			@$connexion = new mysqli("$host", "$user", "$password", "$dbname", "$port");
			
			if ($connexion->connect_error) {
				$chaine = "Connexion PB - ".date("j M Y - G:i:s - ").$user." - ". $connexion->connect_error."\r\n";
				$connexion = FALSE;
			} else {
				 $chaine = "Connexion OK - ".date("j M Y - G:i:s - ").$user."\r\n";
			}

			return $connexion;
		}
	}

	// Fonctione permettant de se déconnecter d'une base de données
	// Ne retourne aucune donnée
	function deconnexion() {
		global $modeacces, $connexion;

		if ($modeacces=="mysql") {
			mysql_close();
		}

		if ($modeacces=="mysqli") {
			$connexion->close();
		}
	}

	// Permet d'exécuter une requête SQL sur la base de données connectée
	// Retourne le résultat de la requête
	function executeSQL($sql) {
		global $modeacces, $connexion;

		if ($modeacces=="mysql") {
			$result = mysql_query($sql)		
			or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
				 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
					mysql_error().
					"<br /><br />
					<b>REQUETE SQL : </b>$sql<br />");		
			return $result;
		}

		if ($modeacces=="mysqli") {
			$result = $connexion->query($sql)		
			or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
				 	Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
					mysqli_error_list($connexion)[0]['error'].      //$mysqli->error_list;
					"<br /><br />
					<b>REQUETE SQL : </b>$sql<br />");				
			return $result;
		}
	}

	// Permet de connaitre le nombre de colonne rendu par une requête SQL
	// Retourne le nombre de colonne
	function compteSQL($sql) {
		global $modeacces, $connexion;
		
		$result = executeSQL($sql);

		if ($modeacces=="mysql") {
			$num_rows = mysql_num_rows($result);
			return $num_rows;
		}

		if ($modeacces=="mysqli") {
			$num_rows = $connexion->affected_rows;
			return $num_rows;
		}
	}

	// Permet de stocker les données d'une requête dans un tableau
	// Retourne le tableau de données
	function tableSQL($sql) {
		global $modeacces, $connexion;
		
		$result = executeSQL($sql);
		$rows=array();

		if ($modeacces=="mysql") {
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
				array_push($rows,$row);
			}
			return $rows;
		}

		if ($modeacces=="mysqli") {
			while ($row = $result->fetch_array(MYSQLI_BOTH)) {
				array_push($rows,$row);
			}
			return $rows;
		}
	}

	// Permet de sélectionner un champ spécifique d'une requête
	// Retourne le champ voulu
	function champSQL($sql) {
		global $modeacces, $connexion;
		
		$result = executeSQL($sql);
		
		if ($modeacces=="mysql") {
			$rows = mysql_fetch_array($result, MYSQL_NUM);
			return $rows[0];
		}

		if ($modeacces=="mysqli") {
			$rows = $result->fetch_array(MYSQLI_NUM);
			return $rows[0];
		}
	}

	// Permet de savoir le nombre de champs rendu par une requête
	// Retourne le nombre de champs concernés
	function nombrechamp($sql) {
		global $modeacces, $connexion;
		
		$result = executeSQL($sql);

		if ($modeacces=="mysql") {
			return mysql_num_fields($result);
		}

		if ($modeacces=="mysqli") {
			return  $result->field_count;
		}
	}

	// Permet de savoir si les logs EXPLOITANT sont correctes
	// Retourne vrai si l'exploitant existe sinon faux
	function connexionExploitant($nomUtilisateur, $motDePasse) {
		$requetLOG = "	SELECT *
						FROM EXPLOITANT
						WHERE exploitantLOG='$nomUtilisateur'
						AND exploitantMDP='$motDePasse';";

		$resultLOG = executeSQL($requetLOG);

		$tableauLOG = mysql_fetch_array($resultLOG, MYSQL_BOTH);

		if (isset($tableauLOG[0])) {
			return true;
		} else {
			return false;
		}
	}
	
	function connexionExploitant($nomUtilisateur, $motDePasse) {
		$requetLOG = "	SELECT *
		FROM EXPLOITANT
		WHERE exploitantLOG='$nomUtilisateur'
		AND exploitantMDP='$motDePasse';";
	
		$resultLOG = executeSQL($requetLOG);
	
		$tableauLOG = mysql_fetch_array($resultLOG, MYSQL_BOTH);
	
		if (isset($tableauLOG[0])) {
			return true;
		} else {
			return false;
		}
	}
	

?>