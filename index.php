<?php

echo "Hello World !";
// Paramètres de connexion à la base de données
$serveur = "adresse_du_serveur_mysql_azure";
$utilisateur = "votre_nom_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$base_de_donnees = "nom_de_votre_base_de_donnees";

echo "Tentative de connexion.";
// Tentative de connexion à la base de données

try {
    $pdo = new PDO('mysql:host=adresse_du_serveur_mysql_azure;dbname=nom_de_votre_base_de_donnees', 'votre_nom_utilisateur', 'votre_mot_de_passe');
    echo "Connexion réussie.";
    
    // Configuration supplémentaire, si nécessaire
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
// Connexion réussie, vous pouvez exécuter des requêtes SQL ou d'autres opérations ici
?>