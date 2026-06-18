<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Crédit Général Populaire - Mes Comptes</title>
	<link rel="stylesheet" href="./css/style_login.css">
	<link rel="stylesheet" href="./css/style_afficherComtes.css">
</head>

<body>

	<header style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 1200px; margin: 0 auto; padding: 1rem 2rem;">
        <img src="./images/logo_banque.png" alt="Crédit Général Populaire" class="logo-img">
        
        <div class="top-right-nav">
			<a href="saisirMessage.php" class="forgot-password" style="font-size: 0.95rem; font-weight: 600;">✉ Contacter mon conseiller</a> &nbsp;|&nbsp;
            <a href="changement_mdp.php" class="forgot-password" style="font-size: 0.95rem;">Changer de mot de passe</a>
        </div>
    </header>

    <main class="dashboard-container">
        <h1>Espace Personnel</h1>
        <p class="user-welcome">Bienvenue sur votre synthèse de comptes</p>

        <section class="accounts-list">


		<?php

		require_once 'db.php';
		require_once 'session.php';
		
		if(!isset($_COOKIE['CGP_sessionID']) || !verifierSession($pdo, $_COOKIE['CGP_sessionID']) ) {
			header('Location:login.php');
			exit();
		} else {
			$idUtilisateur = verifierSession($pdo, $_COOKIE['CGP_sessionID']);
		}
		
		// verification du profil
		$requetProfil = "select profil from utilisateurs where id = $idUtilisateur";
		
		//echo $requetProfil;
		
		$resultat = $pdo->query($requetProfil);
		$infoUtilisateur = $resultat->fetch();
		
		if($infoUtilisateur['profil'] == "CONSEILLER") {
			header('Location:listerMessages.php');
			exit();			
		}
		

		$requete = "select * from comptes where idUtilisateur = " . $idUtilisateur;

		$resultat = $pdo->query($requete);
		$comptesTrouves = $resultat->fetchAll();

		foreach($comptesTrouves as $unCompte) {

			echo('<div class="account-card"><div class="account-details"><div class="account-type">');

            if($unCompte['type'] == "COURANT") {
				echo('<span class="badge badge-courant">Courant</span>');
			} else {
				echo('<span class="badge badge-epargne">Epargne</span>');
			}
            			
			echo('</div><div class="account-number">N° ' . $unCompte['numeroCompte'] . '</div></div>');
                
			echo('<div class="right-section"><div class="account-balance positive">' . $unCompte['solde'] . " " . $unCompte['devise'] . '</div>');
            
			echo('<a href="#" class="btn-action">Gérer</a></div></div>');


	}

?>

	</section>


</body>

</html>