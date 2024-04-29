<?php

echo "Hello World !";
// Paramètres de connexion à la base de données
$serveur = "adresse_du_serveur_mysql_azure";
$utilisateur = "votre_nom_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$base_de_donnees = "nom_de_votre_base_de_donnees";

// Tentative de connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    // Afficher un message d'erreur si la connexion échoue
    echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
    // Arrêter l'exécution du script ou ajouter d'autres instructions pour gérer l'erreur
    exit();
} else {
    // Connexion réussie, vous pouvez exécuter des requêtes SQL ou d'autres opérations ici
    echo "Connexion réussie à la base de données !";
}
?>