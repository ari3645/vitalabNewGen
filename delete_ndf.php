<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id_note_de_frais"])) {

    // Récupérer les données du formulaire
    $id_note_de_frais = $_POST["id_note_de_frais"];

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL d'insertion
        $sql = $pdo->prepare("DELETE FROM note_de_frais WHERE id_note_de_frais = :id_note_de_frais");
        $sql->bindParam(':id_note_de_frais', $id_note_de_frais);
        $sql->execute();

        session_start();
        // Définir un message de réussite dans la session
        $_SESSION['success_message'] = "La note de frais a été supprimé avec succès.";

        // Rediriger vers une autre page
        header("Location: commercial.php");
        exit();

    //Gestion des erreurs
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    // Fermer la connexion à la base de données
    $pdo = null;
} else {
    header("Location: commercial.php");
    exit();
}
?>