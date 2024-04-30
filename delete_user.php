<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $id_utilisateur = $_POST["nom_user"];

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL d'insertion
        $sql = $pdo->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur");

        // Liaison des paramètres
        $sql->bindParam(':id_utilisateur', $id_utilisateur);

        // Exécution de la requête SQL
        $sql->execute();

        // Définir un message de réussite dans la session
        session_start();
        $_SESSION['success_message'] = "L'utilisateur a été ajouté avec succès.";

        // Rediriger vers une autre page
        header("Location: admin.php");
        exit();

    //Gestion des erreurs
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
?>