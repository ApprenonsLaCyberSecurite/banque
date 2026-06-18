# Projet "Crédit Général Populaire"
Dans ce repo, vous trouverez toutes les ressources de la série de vidéos concernant la création du site "Crédit Général Populaire"
Première vidéo de la série : https://www.youtube.com/watch?v=UkaEVHT2oUM

# Rappel important
Toutes les personnes, les sociétés, les noms, les logos utilisés dans cette série sont fictifs et ont été inventés juste pour illustrer notre lab.

# Prérequis pour installer le site 
Le site tourne sur WAMP (ou équivalent).
Vidéo pour installer WAMP server : https://www.youtube.com/watch?v=wGxGJ44bi2c&t

# installation du site
1/ Créer votre base de données
- le site utilise le user root sans mot de passe. 
- nom de la base est : "banque"
- pour créer les tables et le jeu de donnée, lancez le script creationBase.sql du répertoire sql dans phpmyadmin

2/ Fichier PHP
- créer un répertoire "banque" dans le répertoire www de votre WAMPserver
- copiez les fichiers php de ce repo et les sous réperoires dans le répertoire "banque" que vous venez de créer

# Dernières infos
Je rappelle que ceci n'est pas un tutoriel pour développer un site web en PHP. C'est juste un lab truffé de failles de sécurité pour qu'on puisse s'entrainer à les découvrir, les exploiter et les corriger dans un but purement pédagogique :)
