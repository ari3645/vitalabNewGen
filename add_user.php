<?php

// Informations d'identification
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["role"])) {

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

        // echo "hello";

        // $sql_check_existing = "SELECT COUNT(*) FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur OR mail = :mail";
        // $stmt_check_existing = $pdo->prepare($sql_check_existing);
        // $stmt_check_existing->bindParam(':nom_utilisateur', $nom_utilisateur);
        // $stmt_check_existing->bindParam(':mail', $mail);
        // $stmt_check_existing->execute();
        // $result_check_existing = $stmt_check_existing->fetch(PDO::FETCH_ASSOC);

        $result_check_existing=$pdo->query("SELECT COUNT(*) as count FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur' OR mail = '$mail'")->fetch(PDO::FETCH_ASSOC);
        echo $result_check_existing['count'];

        if ($result_check_existing['count'] > 0) {
            session_start();
            $_SESSION['success_message'] = "L'utilisateur existe déjà.";

            // Rediriger vers une autre page
            header("Location: admin.php");
            exit();
        }else {

            // // Préparer la requête SQL d'insertion
            // $sql = $pdo->prepare("INSERT INTO utilisateur (nom_utilisateur, mail, mot_de_passe, id_role) VALUES (:nom_utilisateur, :email, :mot_de_passe, :role_id)");

            // // Liaison des paramètres
            // $sql->bindParam(':nom_utilisateur', $nom_utilisateur);
            // $sql->bindParam(':mail', $mail);
            // $sql->bindParam(':mot_de_passe', $mot_de_passe);
            // $sql->bindParam(':role_id', $role_id);

            // // Exécution de la requête SQL
            // $sql->execute();

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