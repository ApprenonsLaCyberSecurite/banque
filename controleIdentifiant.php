<?php

try {

	require_once 'db.php';
	require_once 'session.php';

	$identifiant = $_POST["identifiant"];
	$motDePasse = $_POST["motDePasse"];

 
	$requete = "select id, profil from utilisateurs where identifiant='" . $identifiant . "' and motDePasse='" . $motDePasse. "'";

	$resultat = $pdo->query($requete);
	$utilisateurTrouve = $resultat->fetch(); 
 
 
 /*
	$requeteAtrou = $pdo->prepare("select id, profil from utilisateurs where identifiant= :idf and motDePasse= :mdp");
	$requeteAtrou->bindParam(':idf', $identifiant);
	$requeteAtrou->bindParam(':mdp', $motDePasse);
	 
	$requeteAtrou->execute();
	$utilisateurTrouve = $requeteAtrou->fetch(); 
	*/
	

	if($utilisateurTrouve ) {
		// l'identification est OK : on a trouve l'utilisateur en base
		
		$sessionID = creerSession($pdo, $utilisateurTrouve['id']);
		if($sessionID) {
			if($utilisateurTrouve['profil'] == "CLIENT") {
				setCookie('CGP_sessionID', $sessionID);
				header('Location:afficherComptes.php');
				exit;
			}
			if($utilisateurTrouve['profil'] == "CONSEILLER") {
				setCookie('CGP_sessionID', $sessionID);
				header('Location:listerMessages.php');
				exit;
			}
		}
		
		header('Location:login.php?erreur=2');
		exit;
	} else {
		// mauvais identifiant ou un mauvais mot passe
		header('Location:login.php?erreur=1');
		exit;	
	}
} catch(Exception $e) {
	echo("ERREUR <br> $requete");
}


?>