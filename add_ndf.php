<?php
// Informations d'identification de la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id_utilisateur'])) {
        $_SESSION['error_message'] = "Vous devez vous connecter pour ajouter une note de frais.";
        header("Location: login.php");
        exit();
    }
    // Récupérer l'ID de l'utilisateur connecté
    $id_utilisateur = $_SESSION['id_utilisateur'];

    // Récupérer les données du formulaire et nettoyer les entrées
    $intitule = filter_input(INPUT_POST, 'intitule');
    $date_facture = filter_input(INPUT_POST, 'date');
    $montant_facture = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $lieu_facture = filter_input(INPUT_POST, 'lieu');
    $type_frais = filter_input(INPUT_POST, 'id_frais', FILTER_VALIDATE_INT);
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $statut = "En attente"; // Statut par défaut

    if (!empty($intitule) && !empty($date_facture) && !empty($montant_facture) && !empty($lieu_facture) && !empty($type_frais) && !empty($id_utilisateur) && !empty($statut) && ($type_frais <= 10) && ($type_frais >= 1) && ($montant_facture > 0) && ($id_utilisateur > 0)){
        try {
            // Se connecter à la base de données
            $dsn = "mysql:host=$serveur;dbname=$dbname";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour insérer une note de frais
            $sql = $pdo->prepare("INSERT INTO note_de_frais (intitule, date_facture, montant_facture, lieu_facture, image_facture, id_frais, id_utilisateur, statut) VALUES (:intitule, :date_facture, :montant_facture, :lieu_facture, 'image', :type_frais, :id_utilisateur, :statut)");
            $sql->bindParam(':intitule', $intitule);
            $sql->bindParam(':date_facture', $date_facture);
            $sql->bindParam(':montant_facture', $montant_facture);
            $sql->bindParam(':lieu_facture', $lieu_facture);
            $sql->bindParam(':type_frais', $type_frais);
            $sql->bindParam(':id_utilisateur', $id_utilisateur);
            $sql->bindParam(':statut', $statut);
            $sql->execute();

            // Message de succès
            $_SESSION['success_message'] = "Note de frais ajoutée avec succès.";

            // Rediriger vers une autre page
            header("Location: commercial.php");
            exit();
        // Gestion des erreurs
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Erreur lors de l'ajout de la note de frais : " . $e->getMessage();
            header("Location: commercial.php");
            exit();
        }
    } else {
        // Message d'erreur
        $_SESSION['error_message'] = "Veuillez remplir tous les champs.";
        header("Location: commercial.php");
        exit();
    }
} else {
    header("Location: commercial.php");
    exit();
}
?>