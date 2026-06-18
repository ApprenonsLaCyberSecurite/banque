<?php

	require_once 'db.php';
	require_once 'session.php';
		
	if(!isset($_COOKIE['CGP_sessionID']) || !verifierSession($pdo, $_COOKIE['CGP_sessionID']) ) {
		header('Location:login.php');
		exit();
	} else {
		$idUtilisateur = verifierSession($pdo, $_COOKIE['CGP_sessionID']);
	}
	
	// Controle que les 2 mots de passe sont transmis et sont les memes
	if(isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['old_password'])) {
		$mdp1 = $_POST['new_password'];
		$mdp2 = $_POST['confirm_password'];
		$old = $_POST['old_password'];
		
		if($mdp1 == $mdp2) {
			$requeteMiseAjour = "update utilisateurs set motDePasse = '$mdp1' where id=$idUtilisateur and motDePasse='$old'";
			$nbLignesMisesAJour = $pdo -> exec($requeteMiseAjour);
		}
	} 
				
	header('Location:afficherComptes.php');
	exit();	


?>