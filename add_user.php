<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["role"]) && ($_POST["role"] <= 3 && $_POST["role"] >= 1)) {

    // Récupérer les données du formulaire
    $nom_utilisateur = filter_input(INPUT_POST, 'id');
    $mail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mot_de_passe = filter_input(INPUT_POST, 'mdp');
    $role_id = filter_input(INPUT_POST, 'role', FILTER_VALIDATE_INT);

    if ($nom_utilisateur && $mail && $mot_de_passe && $role_id !== false) {

        try {
            // Se connecter à la base de données
            $dsn = "mysql:host=$serveur;dbname=$dbname";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $est_existant = $pdo->prepare("SELECT COUNT(*) as count FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur OR mail = :mail");
            $est_existant->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
            $est_existant->bindParam(':mail', $mail, PDO::PARAM_STR);
            $est_existant->execute();
            $si_existant = $est_existant->fetch(PDO::FETCH_ASSOC);

            if ($si_existant['count'] > 0) {
                session_start();
                $_SESSION['success_message'] = "L'utilisateur existe déjà.";

                // Rediriger vers une autre page
                header("Location: admin.php");
                exit();

            }else {
                $stmt = $pdo->prepare("INSERT INTO utilisateur (nom_utilisateur, mail, mot_de_passe, id_role) VALUES (:nom_utilisateur, :mail, :mot_de_passe, :role_id)");
                $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
                $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
                $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
                $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
                $stmt->execute(); 

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
    } else {
        // Message d'erreur
        session_start();
        $_SESSION['success_message'] = "Veuillez remplir tous les champs.";

        // Rediriger vers une autre page
        header("Location: admin.php");
        exit();
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