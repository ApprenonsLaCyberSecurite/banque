<?php

	require_once 'db.php';
	require_once 'session.php';
		
	if(!isset($_COOKIE['CGP_sessionID']) || !verifierSession($pdo, $_COOKIE['CGP_sessionID']) ) {
		header('Location:login.php');
		exit();
	} 
	
	$idConseiller = verifierSession($pdo, $_COOKIE['CGP_sessionID']);
	$requeteInfoConseiller = "select nom, prenom from utilisateurs where id=$idConseiller and profil = 'CONSEILLER'";
	$resultat = $pdo->query($requeteInfoConseiller);
	$conseiller = $resultat->fetch();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crédit Général Populaire - Messages Clients</title>
    <style>
        :root {
            --primary-dark: #005c30; /* Vert foncé du logo */
            --primary-light: #52b788; /* Vert clair du logo */
            --bg-gradient-start: #f4f9f5;
            --bg-gradient-end: #e8f5ed;
            --text-main: #2d3748;
            --white: #ffffff;
            --slate-grey: #718096;
            --border-color: rgba(82, 183, 136, 0.2);
            /* Nouvelles couleurs pour la gestion des messages */
            --badge-haute: #fee2e2;
            --text-haute: #991b1b;
            --badge-normale: #fef3c7;
            --text-normale: #92400e;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            color: var(--text-main);
            padding: 2rem;
        }

        /* Header Layout - Aligné avec la présentation de la page jointe */
        header {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            width: 100%; 
            max-width: 1200px; 
            margin: 0 auto 2.5rem auto; 
            padding: 1rem 2rem;
        }

        .logo-img {
            max-width: 200px;
            height: auto;
        }

        .top-right-nav {
            font-size: 0.95rem;
        }

        .forgot-password {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Main Container */
        .dashboard-container {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 92, 48, 0.06);
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border: 1px solid var(--border-color);
        }

        h1 {
            color: var(--primary-dark);
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .user-welcome {
            color: var(--slate-grey);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Messages List Styles (Adapté de .accounts-list) */
        .messages-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .message-card {
            background: var(--white);
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .message-card:hover {
            border-color: var(--primary-light);
            box-shadow: 0 4px 12px rgba(82, 183, 136, 0.15);
            transform: translateY(-2px);
        }

        /* Gestion de l'état Non Lu (Bordure plus épaisse ou colorée) */
        .message-card.unread {
            border-left: 5px solid var(--primary-dark);
        }

        .message-details {
            text-align: left;
            max-width: 70%;
        }

        .client-info {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-haute {
            background-color: var(--badge-haute);
            color: var(--text-haute);
        }

        .badge-normale {
            background-color: var(--badge-normale);
            color: var(--text-normale);
        }

        .message-subject {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        .message-preview {
            font-size: 0.9rem;
            color: var(--slate-grey);
            white-space: nowrap;
            overflow: hidden;
            text-transform: none;
            text-overflow: ellipsis;
        }

        .right-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .message-date {
            font-size: 0.9rem;
            color: var(--slate-grey);
            text-align: right;
            min-width: 80px;
        }

        /* Action button style */
        .btn-action {
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #004d28 100%);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.1s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            box-shadow: 0 4px 12px rgba(0, 92, 48, 0.3);
        }

        .btn-action:active {
            transform: scale(0.98);
        }

        .footer-info {
            margin-top: 3rem;
            font-size: 0.75rem;
            color: var(--slate-grey);
            text-align: center;
            width: 100%;
        }

        .footer-info a {
            color: var(--primary-dark);
            text-decoration: none;
        }
        
        .footer-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header>
        <!-- Utilisation directe du fichier logo_banque.png -->
        <img src="./images/logo_banque.png" alt="Crédit Général Populaire" class="logo-img">
        
        <div class="top-right-nav">
            <?php
				echo('<span style="color: var(--slate-grey);">Conseiller : ' . $conseiller['prenom'] . " " . $conseiller['nom'] . "</span>");
			?>
			<!--
			&nbsp;|&nbsp; 
            <a href="#" class="forgot-password" style="font-size: 0.95rem;">Déconnexion</a>
			-->
        </div>
    </header>

    <main class="dashboard-container">
        <h1>Espace Conseiller</h1>
        <p class="user-welcome">Gestion des messages clients en attente de réponse</p>

        <section class="messages-list">
		
			<?php
			
				$requeteMessages = "select m.id, m.message, m.theme, m.objet, m.dateEnvoi, u.nom, u.prenom from messages m join utilisateurs u on m.idUtilisateur = u.id";
				$resultat = $pdo->query($requeteMessages);
				$listeMessages = $resultat->fetchAll();

				foreach($listeMessages as $unMessage) {
					echo('<div class="message-card unread">');
					echo('<div class="message-details">');
                    echo('<div class="client-info">' . $unMessage['prenom'] . " " . $unMessage['nom'] . '</div>');
					echo('<div class="message-subject">' . $unMessage['theme'] . '</div>');
					echo('<div class="message-preview">' . $unMessage['message'] . '</div>');
					echo('</div>');
					echo('<div class="right-section"><div class="message-date">' . $unMessage['dateEnvoi'] . '</div>');
					echo('<a href="#" class="btn-action">Répondre</a></div></div>');
				}
			
			?>

        </section>
    </main>

    <footer class="footer-info">
        <p>&copy; 2026 Crédit Général Populaire. Espace Professionnel sécurisé. <a href="#">Assistance</a></p>
    </footer>

</body>
</html>