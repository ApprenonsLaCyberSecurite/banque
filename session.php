<?php

function creerSession($pdo, $idUtilisateur) {
	
	// nettoyage des anciennes sessions
	$requeteSuppression = "delete from sessions where idUtilisateur=$idUtilisateur";
	$nbLignesSupprimees = $pdo -> exec($requeteSuppression);
	
	$sessionID = bin2hex(random_bytes(16));
	$requeteCreation = "insert into sessions (sessionID, idUtilisateur, dateExpiration) values ('$sessionID', $idUtilisateur, NOW() + INTERVAL 1 HOUR)";
	$nbLignesCreees = $pdo -> exec($requeteCreation);
	
	if($nbLignesCreees == 1) { 
		return $sessionID;
	}
	
	return null;
	
}

function verifierSession($pdo, $sessionID) {
	
	$requete = "select idUtilisateur from sessions where sessionID='$sessionID' and dateExpiration > now()";
	$resultat = $pdo->query($requete);
	$sessionTrouvee = $resultat->fetch();
	
	if($sessionTrouvee) {
		return $sessionTrouvee['idUtilisateur'];
		
	}
	
	return null;
	
}


?>