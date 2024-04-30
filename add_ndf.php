<?php
// Informations d'identification de la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Récupérer les données du formulaire
    $intitule = $_POST["intitule"];
    $date_facture = $_POST["date_facture"];
    $montant_facture = $_POST["montant_facture"];
    $lieu_facture = $_POST["lieu_facture"];
    $type_frais = $_POST["id_frais"];
    $statut = "En attente"; // Statut par défaut

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql=$pdo->query("INSERT INTO note_de_frais (intitule, date_facture, montant_facture, lieu_facture, id_frais, statut) VALUES ('$intitule',STR_TO_DATE('$date_facture', '%Y-%m-%d'), '$montant_facture', '$lieu_facture', '$type_frais', '$statut')");
        // // Préparer la requête SQL d'insertion
        // $sql = $pdo->prepare("INSERT INTO note_de_frais (date_facture, montant_facture, lieu_facture, id_frais, id_utilisateur, statut) VALUES (:date_facture, :montant_facture, :lieu_facture, :id_frais, :statut)");

        // // Liaison des paramètres
        // $sql->bindParam(':id_utilisateur', $id_utilisateur);

        // $sql->bindParam(':date_facture', $date_facture);
        // $sql->bindParam(':montant_facture', $montant_facture);
        // $sql->bindParam(':lieu_facture', $lieu_facture);
        // $sql->bindParam(':id_frais', $type_frais);
        // $sql->bindParam(':statut', $statut);

        // Exécution de la requête SQL
        // $sql->execute();

        echo "La note de frais a été ajoutée avec succès.";

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
?>