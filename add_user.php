<?php

$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

echo "entree";
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["id"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mdp"];
    $role_id = $_POST["role"]; // Supposons que vous avez un champ pour le rôle de l'utilisateur

    echo $nom_utilisateur;
    echo $email;

    try {
        // Connexion à la base de données (assurez-vous de remplacer les valeurs par les vôtres)
        $dsn = "mysql:host=$serveur;dbname=$dbname";

        echo $pass;

        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL d'insertion
        $sql = "INSERT INTO utilisateur (nom_utilisateur, email, mot_de_passe, role_id) VALUES (:nom_utilisateur, :email, :mot_de_passe, :role_id)";
        $stmt = $pdo->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':role_id', $role_id);

        // Exécution de la requête SQL
        $stmt->execute();

        echo "L'utilisateur a été ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    echo "hello";
    // Fermer la connexion à la base de données
    $pdo = null;
}
?>