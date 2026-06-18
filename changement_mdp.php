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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du mot de passe</title>
    <link rel="stylesheet" href="./css/style_login.css">
</head>
<body>

    <div class="login-container">
        <div class="logo-area">
            <img src="./images/logo_banque.png" alt="Logo Banque" class="logo-img">
        </div>

        <h2>Modifier votre mot de passe</h2>

        <div id="error-message" class="message" style="display: none;">
            <span id="error-text">Les mots de passe ne correspondent pas.</span>
        </div> 

        <form id="password-form" action="./miseAJour_mdp.php" method="POST">
            
            <div class="form-group">
                <label for="old-password">Mot de passe actuel</label>
                <input type="password" id="old-password" name="old_password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="new-password">Nouveau mot de passe</label>
                <input type="password" id="new-password" name="new_password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmer le nouveau mot de passe</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="••••••••" required>
            </div>

            <!--div class="options-row" style="justify-content: flex-end;">
                <a href="login.html" class="forgot-password">Retour à la connexion</a>
            </div-->

            <button type="submit" class="btn-submit">Mettre à jour le mot de passe</button>

        </form>
    </div>

    <div class="footer-info">
        <p>Pour des raisons de sécurité, choisissez un mot de passe fort contenant des lettres, chiffres et caractères spéciaux.</p>
        <p style="margin-top: 0.5rem;"><a href="#">Besoin d'aide ?</a></p>
    </div>

    <script>
        const form = document.getElementById('password-form');
        const newPassword = document.getElementById('new-password');
        const confirmPassword = document.getElementById('confirm-password');
        const errorMessage = document.getElementById('error-message');
        const errorText = document.getElementById('error-text');

        form.addEventListener('submit', function(event) {
            // On vérifie si les deux champs ont une valeur différente
            if (newPassword.value !== confirmPassword.value) {
                // 1. On empêche l'envoi du formulaire au serveur
                event.preventDefault(); 
                
                // 2. On met à jour le texte et on affiche le bloc d'erreur rouge
                errorText.textContent = "⚠️ Les deux nouveaux mots de passe ne sont pas identiques.";
                errorMessage.style.display = 'flex';
                
                // 3. Optionnel : On ajoute une bordure rouge sur le champ de confirmation
                confirmPassword.style.borderColor = '#FF0000';
            } else {
                // Si tout est bon, on cache le message (au cas où il était affiché avant)
                errorMessage.style.display = 'none';
                confirmPassword.style.borderColor = '#cbd5e1';
            }
        });

        // Optionnel : Réinitialiser la bordure rouge dès que l'utilisateur modifie sa saisie
        confirmPassword.addEventListener('input', function() {
            confirmPassword.style.borderColor = '';
        });
    </script>

</body>
</html>