<?php
// // Informations d'identification de la base de données
// $serveur = "vitalab-new-gen.mysql.database.azure.com";
// $dbname = "vitalab-new-gen";
// $user = "albinrvi";
// $pass = "Ari69.008";

// // Vérifier si le formulaire a été soumis
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     session_start( );
//     $id_utilisateur = $_SESSION['id_utilisateur'];

//     // Récupérer les données du formulaire
//     $id_note_de_frais = $_POST["id_modif"];
//     $intitule = $_POST["intitule"];
//     $date_facture = $_POST["date"];
//     $montant_facture = $_POST["montant"];
//     $lieu_facture = $_POST["lieu"];
//     $id_frais = $_POST["id_frais"];

//     if (!empty($intitule) && !empty($date_facture) && !empty($montant_facture) && !empty($lieu_facture) && !empty($id_frais) && !empty($id_utilisateur)){
//         try {
//             // Se connecter à la base de données
//             $dsn = "mysql:host=$serveur;dbname=$dbname";
//             $pdo = new PDO($dsn, $user, $pass);
//             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//             //Requete qui récupère la valeur du statut de la note de frais
//             $statut = $pdo->query("SELECT statut FROM note_de_frais WHERE id_note_de_frais = $id_note_de_frais")->fetch(PDO::FETCH_ASSOC);

//             if ($statut['statut'] == 'En attente' || $statut['statut'] == 'en attente') {
//                 $stmt = $pdo->prepare("UPDATE note_de_frais
//                 SET intitule = :intitule,
//                     date_facture = :date_facture,
//                     montant_facture = :montant_facture,
//                     lieu_facture = :lieu_facture,
//                     id_frais = :id_frais
//                 WHERE id_note_de_frais = :id_note_de_frais");

//                 // Liaison des valeurs aux paramètres liés
//                 $stmt->bindParam(':intitule', $intitule);
//                 $stmt->bindParam(':date_facture', $date_facture);
//                 $stmt->bindParam(':montant_facture', $montant_facture);
//                 $stmt->bindParam(':lieu_facture', $lieu_facture);
//                 $stmt->bindParam(':id_frais', $id_frais);
//                 $stmt->bindParam(':id_note_de_frais', $id_note_de_frais);

//                 // Exécution de la requête
//                 $stmt->execute();


//                 // Message de succès
//                 session_start();
//                 $_SESSION['success_message'] = "Note de frais ajoutée avec succès.";

//                 // Rediriger vers une autre page
//                 header("Location: commercial.php");
//                 exit();
//             } else {
//                 // Message d'erreur
//                 session_start();
//                 $_SESSION['success_message'] = "La note de frais ne peut pas être modifiée.";
                
//                 // Rediriger vers une autre page
//                 header("Location: commercial.php");
//                 exit();
//             }

//         // Gestion des erreurs
//         } catch (PDOException $e) {
//             echo "Erreur : " . $e->getMessage();
//         }

//     } else {
//         // Message d'erreur
//         session_start();
//         $_SESSION['success_message'] = "Veuillez remplir tous les champs.";

//         // Rediriger vers une autre page
//         header("Location: commercial.php");
//         exit();
//     }
//     // Fermer la connexion à la base de données
//     $pdo = null;
// }
?>

<?php
// Informations d'identification de la base de données
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

// Vérifier si le formulaire a été soumis de manière sécurisée
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Démarrer la session de manière sécurisée
    session_start();

    // Valider l'existence et le type de données de session
    if (isset($_SESSION['id_utilisateur']) && is_numeric($_SESSION['id_utilisateur'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];
    } else {
        // Rediriger en cas de problème avec la session
        header("Location: error.php");
        exit();
    }

    // Nettoyer et valider les données du formulaire
    $intitule = filter_input(INPUT_POST, 'intitule', FILTER_SANITIZE_STRING);
    $date_facture = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $montant_facture = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    $lieu_facture = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);
    $id_frais = filter_input(INPUT_POST, 'id_frais', FILTER_VALIDATE_INT);
    $id_note_de_frais = filter_input(INPUT_POST, 'id_modif', FILTER_VALIDATE_INT);

    // Vérifier que toutes les données ont été fournies et sont valides
    if ($intitule && $date_facture && $montant_facture !== false && $lieu_facture && $id_frais && $id_note_de_frais) {
        try {
            // Se connecter à la base de données de manière sécurisée
            $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête sécurisée pour récupérer le statut de la note de frais
            $stmt_statut = $pdo->prepare("SELECT statut FROM note_de_frais WHERE id_note_de_frais = :id_note_de_frais");
            $stmt_statut->bindParam(':id_note_de_frais', $id_note_de_frais, PDO::PARAM_INT);
            $stmt_statut->execute();
            $statut = $stmt_statut->fetchColumn();

            // Vérifier le statut de la note de frais
            if ($statut === 'En attente' || $statut === 'en attente') {
                // Requête sécurisée pour mettre à jour la note de frais
                $stmt_update = $pdo->prepare("UPDATE note_de_frais
                                              SET intitule = :intitule,
                                                  date_facture = :date_facture,
                                                  montant_facture = :montant_facture,
                                                  lieu_facture = :lieu_facture,
                                                  id_frais = :id_frais
                                              WHERE id_note_de_frais = :id_note_de_frais");

                // Liaison des valeurs aux paramètres liés
                $stmt_update->bindParam(':intitule', $intitule);
                $stmt_update->bindParam(':date_facture', $date_facture);
                $stmt_update->bindParam(':montant_facture', $montant_facture);
                $stmt_update->bindParam(':lieu_facture', $lieu_facture);
                $stmt_update->bindParam(':id_frais', $id_frais, PDO::PARAM_INT);
                $stmt_update->bindParam(':id_note_de_frais', $id_note_de_frais, PDO::PARAM_INT);

                // Exécution de la requête
                $stmt_update->execute();

                // Message de succès
                $_SESSION['success_message'] = "Note de frais modifiée avec succès.";

                // Redirection vers une autre page en cas de succès
                header("Location: commercial.php");
                exit();
            } else {
                // Message d'erreur
                $_SESSION['error_message'] = "La note de frais ne peut pas être modifiée.";

                // Redirection vers une autre page en cas d'erreur
                header("Location: commercial.php");
                exit();
            }

        // Gestion des exceptions PDO
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } finally {
            // Fermer la connexion à la base de données
            $pdo = null;
        }
    } else {
        // Message d'erreur
        $_SESSION['error_message'] = "Veuillez remplir tous les champs avec des valeurs valides.";

        // Redirection vers une autre page en cas d'erreur de validation
        header("Location: commercial.php");
        exit();
    }
} else {
    // Redirection vers une autre page si le formulaire n'a pas été soumis via la méthode POST
    header("Location: error.php");
    exit();
}
?>
