<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Crédit Général Populaire</title>
	<link rel="stylesheet" href="./css/style_login.css">

</head>
<body>

    <div class="login-container">
        <div class="logo-area">
            <img src="./images/logo_banque.png" alt="Crédit Général Populaire" class="logo-img">
        </div>

        <h2>Espace Personnel</h2>
		
		<?php
		if(isset($_GET["erreur"]) && $_GET["erreur"] == 1) {
			echo("<div id='message' class='message'>Erreur : mauvais identifiant ou mot de passe</div>");
		}
		?>

        <form action="./controleIdentifiant.php" method="POST">
            <div class="form-group">
                <label for="username">Identifiant (Numéro de client)</label>
                <input type="text" id="username" name="identifiant" required autocomplete="username" placeholder="Ex: 12345678">
            </div>

            <div class="form-group">
                <label for="password">Code secret / Mot de passe</label>
                <input type="password" id="password" name="motDePasse" required autocomplete="current-password" placeholder="••••••••">
            </div>

			<!--
            <div class="options-row">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Se souvenir de mon identifiant
                </label>
                <a href="#" class="forgot-password">Code oublié ?</a>
            </div>
			-->

            <button type="submit" class="btn-submit">Valider et accéder à mes comptes</button>
        </form>
    </div>

    <div class="footer-info">
        <p>© 2026 Crédit Général Populaire. Tous droits réservés.</p>
        <p><a href="#">Mentions légales</a> | <a href="#">Protection des données</a> | <a href="#">Contact</a></p>
    </div>

</body>
</html>