<?php
// Informations d'identification de la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Récupérer l'identifiant de la note de frais à mettre à jour
$id_note_de_frais = $_POST["id_note_de_frais"];

try {
    // Se connecter à la base de données
    $dsn = "mysql:host=$serveur;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête SQL pour mettre à jour le statut de la note de frais
    $stmt = $pdo->prepare("UPDATE note_de_frais SET statut = 'Refusée' WHERE id_note_de_frais = :id_note_de_frais");

    // Liaison des valeurs aux paramètres liés
    $stmt->bindParam(':id_note_de_frais', $id_note_de_frais);

    // Exécuter la requête
    $stmt->execute();

    session_start();
    $_SESSION['success_message'] = "La note de frais a été refusée avec succès.";
    // Rediriger vers une autre page ou afficher un message de succès
    header("Location: page_de_redirection.php");
    exit();

} catch (PDOException $e) {
    // Gérer les erreurs de la base de données
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$pdo = null;
?>
