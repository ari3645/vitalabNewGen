<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="formulaire.css"/>
    <link rel="icon" href="images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <div class="card">

        <center><img src="images/logo.png" class="img-com-so" style="width: 18rem;"></center>
        <p>&nbsp;</p>
        <p>Identifiant</p>
        <input type="text">
       
        <p>Mot de passe</p>
        <input type="password">
        
        <center><a href="" class="bn1">Connexion</a></center>
    </div>
   
        
    
</body>
</html>

<?php

// echo "Hello World !";
// Paramètres de connexion à la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$utilisateur = "albinrvi";
$mdp = "Ari69.008";
$dbname = "vitalab-new-gen";

// echo "Tentative de connexion.";
// Tentative de connexion à la base de données

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $utilisateur, $mdp);
    // echo "Connexion réussie.";
    
    // Configuration supplémentaire, si nécessaire
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
// Connexion réussie, vous pouvez exécuter des requêtes SQL ou d'autres opérations ici
?>