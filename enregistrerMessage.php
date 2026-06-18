<?php

	require_once 'db.php';
	require_once 'session.php';
		
	if(!isset($_COOKIE['CGP_sessionID']) || !verifierSession($pdo, $_COOKIE['CGP_sessionID']) ) {
		header('Location:login.php');
		exit();
	} 
	
	$idUtilisateur = verifierSession($pdo, $_COOKIE['CGP_sessionID']);
	
	if(isset($_POST['message']) && isset($_POST['theme']) && isset($_POST['objet'])) {
		$message = htmlspecialchars($_POST['message']);
		$theme = htmlspecialchars($_POST['theme']);
		$objet = htmlspecialchars($_POST['objet']);
		$requeteEnregistrerMessage = "insert into messages (idUtilisateur, message, theme, objet, dateEnvoi) values ($idUtilisateur, '$message', '$theme', '$objet', NOW())";
		$nbLignesCreees = $pdo -> exec($requeteEnregistrerMessage);
	}
	
	header('Location:afficherComptes.php');
	exit();

?>