<?php

	require_once 'db.php';
	require_once 'session.php';
		
	if(!isset($_COOKIE['CGP_sessionID']) || !verifierSession($pdo, $_COOKIE['CGP_sessionID']) ) {
		header('Location:login.php');
		exit();
	} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contacter mon conseiller - Crédit Général Populaire</title>
    <style>
        :root {
            --primary-dark: #005c30; /* Vert foncé du logo */
            --primary-light: #52b788; /* Vert clair du logo */
            --bg-gradient-start: #f4f9f5;
            --bg-gradient-end: #e8f5ed;
            --text-main: #2d3748;
            --white: #ffffff;
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--text-main);
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 92, 48, 0.08);
            width: 100%;
            max-width: 500px; /* Légèrement élargi pour le confort d'un champ message */
            text-align: center;
            border: 1px solid rgba(82, 183, 136, 0.2);
        }

        .logo-area {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        /* Reproduction fidèle du logo textuel et graphique en SVG pour autonomie complète */
        .logo-svg {
            width: 100%;
            max-width: 260px;
            height: auto;
        }

        h2 {
            color: var(--primary-dark);
            font-size: 1.35rem;
            margin-bottom: 1.75rem;
            font-weight: 600;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-weight: 500;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
            background-color: var(--white);
            color: var(--text-main);
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23005c30' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2em;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.2);
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #004d28) 100%;
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.1s ease, box-shadow 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            box-shadow: 0 4px 12px rgba(0, 92, 48, 0.3);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .footer-info {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #718096;
            text-align: center;
            max-width: 500px;
        }

        .footer-info a {
            color: var(--primary-dark);
            text-decoration: none;
        }

        .footer-info a:hover {
            text-decoration: underline;
        }

        /* Message de succès (adapté de la classe .message d'erreur) */
		.message-success {
            display: none;
            align-items: center;
            gap: 0.5rem;
            background-color: #eafaf1;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            color: #1b4332;
            text-align: left;
            border: 1px solid #b7e4c7;
        }
		
		.logo-img {
            max-width: 220px;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo-area">
			<img src='./images/logo_banque.png' alt="Logo Banque" class="logo-img"/>
		</div>

        <h2>Contacter mon conseiller</h2>

        <div id="successMessage" class="message-success">
            ✓ Votre message a bien été envoyé. Votre conseiller vous répondra sous 24h ouvrées.
			<center><a href='./afficherComptes.php'>Mes comptes</a></center>
        </div>

        <form id="contactForm" action='enregistrerMessage.php' method='POST'>
            <div class="form-group">
                <label for="theme">Thématique de votre demande</label>
                <select id="theme" name='theme' required>
                    <option value="" disabled selected>Choisir un thème...</option>
                    <option value="comptes">Gestion de mes comptes & cartes</option>
                    <option value="credits">Demande de crédit ou financement</option>
                    <option value="epargne">Épargne & Placements</option>
                    <option value="assurances">Assurances & Prévoyance</option>
                    <option value="incident">Signaler une fraude ou un incident</option>
                    <option value="autre">Autre demande</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Objet du message</label>
                <input type="text" id="subject" name='objet' placeholder="Ex: Prise de rendez-vous, renouvellement de carte..." required>
            </div>

            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea id="message" name='message' placeholder="Rédigez ici votre question de manière détaillée..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">Envoyer le message</button>
        </form>
    </div>

    <div class="footer-info">
        Besoin d'aide urgente ? Vous pouvez aussi joindre notre assistance téléphonique au 3456 (service gratuit + prix appel) ou consulter notre <a href="#faq">Foire Aux Questions</a>.
    </div>

</body>
</html>
