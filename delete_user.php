<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST"  && !empty($_POST["nom_user"])) {

    // Récupérer les données du formulaire
    $nom_utilisateur = filter_input(INPUT_POST, 'nom_user', FILTER_SANITIZE_STRING);

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'utilisateur a des notes de frais
        $checkSql = $pdo->prepare("SELECT COUNT(*) FROM note_de_frais WHERE nom_utilisateur = :nom_utilisateur");
        $checkSql->bindParam(':nom_utilisateur', $nom_utilisateur);
        $checkSql->execute();
        $notesCount = $checkSql->fetchColumn();

        if ($notesCount > 0) {
            session_start();
            // Définir un message d'erreur dans la session
            $_SESSION['success_message'] = "L'utilisateur ne peut pas être supprimé.";

            // Rediriger vers une autre page
            header("Location: admin.php");
            exit();
        } else {
            // Requête SQL pour supprimer un utilisateur
            $sql = $pdo->prepare("DELETE FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur");
            $sql->bindParam(':nom_utilisateur', $nom_utilisateur);
            $sql->execute();

            session_start();
            // Définir un message de réussite dans la session
            $_SESSION['success_message'] = "L'utilisateur a été supprimé avec succès.";

            // Rediriger vers une autre page
            header("Location: admin.php");
            exit();
        }

    //Gestion des erreurs
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    // Fermer la connexion à la base de données
    $pdo = null;
} else {
    header("Location: admin.php");
    exit();
}
?>