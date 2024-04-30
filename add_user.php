<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["id"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mdp"];
    $role_id = $_POST["role"];

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL d'insertion
        $sql = $pdo->prepare("INSERT INTO utilisateur (nom_utilisateur, mail, mot_de_passe, id_role) VALUES (:nom_utilisateur, :email, :mot_de_passe, :role_id)");

        // Liaison des paramètres
        $sql->bindParam(':nom_utilisateur', $nom_utilisateur);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':mot_de_passe', $mot_de_passe);
        $sql->bindParam(':role_id', $role_id);

        // Exécution de la requête SQL
        $sql->execute();

        // Définir un message de réussite dans la session
        session_start();
        $_SESSION['success_message'] = "L'utilisateur a été ajouté avec succès.";

        // Rediriger vers une autre page
        header("Location: admin.php");
        exit();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
?>