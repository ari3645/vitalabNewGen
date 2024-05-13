<?php
// Informations d'identification de la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_note_de_frais"])) {
    // Récupérer l'identifiant de la note de frais à mettre à jour
    $id_note_de_frais = filter_input(INPUT_POST, 'id_note_de_frais', FILTER_VALIDATE_INT);

    if ($id_note_de_frais !== false) {
        try {
            // Se connecter à la base de données
            $dsn = "mysql:host=$serveur;dbname=$dbname";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Reqête SQL pour mettre à jour le statut de la note de frais
            $sql = $pdo->prepare("UPDATE note_de_frais SET statut = 'Refusée' WHERE id_note_de_frais = :id_note_de_frais");
            $sql->bindParam(':id_note_de_frais', $id_note_de_frais);
            $sql->execute();
    
            session_start();

            // Définir un message de succès dans la session
            $_SESSION['accept_ndf'] = "La note de frais a été refusée avec succès.";

            // Rediriger vers une autre page ou afficher un message de succès
            header("Location: comptable.php");
            exit();
    
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            echo "Erreur : " . $e->getMessage();
        }
    
    } else {
        // Si l'identifiant de la note de frais est invalide
        echo "Identifiant de note de frais invalide.";
    }
} else {
    // Si l'identifiant de la note de frais n'a pas été envoyé via la méthode POST
    echo "L'identifiant de la note de frais est manquant.";
}
?>
