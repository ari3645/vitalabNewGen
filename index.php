<?php

echo "Hello World !";
// Paramètres de connexion à la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$utilisateur = "albinrvi";
$mdp = "Ari69.008";
$dbname = "vitalab-new-gen";

echo "Tentative de connexion.";
// Tentative de connexion à la base de données

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    echo "Connexion réussie.";
    
    // Configuration supplémentaire, si nécessaire
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
// Connexion réussie, vous pouvez exécuter des requêtes SQL ou d'autres opérations ici
?>