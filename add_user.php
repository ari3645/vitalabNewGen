<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["role"]) && ($_POST["role"] <= 3)) {

    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["id"];
    $mail = $_POST["email"];
    $mot_de_passe = $_POST["mdp"];
    $role_id = $_POST["role"];

    try {
        // Se connecter à la base de données
        $dsn = "mysql:host=$serveur;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result_check_existing=$pdo->query("SELECT COUNT(*) as count FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur' OR mail = '$mail'")->fetch(PDO::FETCH_ASSOC);

        if ($result_check_existing['count'] > 0) {
            session_start();
            $_SESSION['success_message'] = "L'utilisateur existe déjà.";

            // Rediriger vers une autre page
            header("Location: admin.php");
            exit();
        }else {

            $sql = "INSERT INTO utilisateur (nom_utilisateur, mail, mot_de_passe, id_role) VALUES ('$nom_utilisateur', '$mail', '$mot_de_passe', '$role_id')";
            $pdo->exec($sql);  

            // Définir un message de réussite dans la session
            session_start();
            $_SESSION['success_message'] = "L'utilisateur a été ajouté avec succès.";

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
    session_start();
        $_SESSION['success_message'] = "Veuillez remplir tous les champs.";

        // Rediriger vers une autre page
        header("Location: admin.php");
        exit();
}
?>