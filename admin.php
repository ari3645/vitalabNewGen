<?php
session_start();
?>


<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="admin.css"/>
    <link rel="icon" href="images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <nav class="navbar">
        <div class="container1"> 
          <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Bootstrap" class="img-nav">
          </a>
          

        </div>
        <center><p><h4>Vitalab New Gen</h4></p></center>
        <div class="dropdown">
          <button href="" class="btn41-43 btn-42" onclick="logouta()">
            Déconnexion
          </button>

          <script>
            function logouta() {
              window.location.href = "index.php";
            }
            </script>
        </div>
    </nav>
    <nav class="container2">
        <div class="right" >
          <h3><center>Liste notes de frais</center></h3>
          <div class="note">
            <ul>
              <?php
                // Informations d'identification
                $serveur = "vitalab-new-gen.mysql.database.azure.com";
                $dbname = "vitalab-new-gen";
                $user = "albinrvi";
                $pass = "Ari69.008";

                try {
                    // Connexion à la base de données
                    $dsn = "mysql:host=$serveur;dbname=$dbname";
                    $pdo = new PDO($dsn, $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Exécuter la requête SQL pour récupérer le nom de l'utilisateur, l'intitulé de la note de frais et le type de frais
                    $sql = "SELECT u.nom_utilisateur, nf.intitule, tf.type_frais 
                            FROM note_de_frais nf 
                            INNER JOIN utilisateur u ON nf.id_utilisateur = u.id_utilisateur 
                            INNER JOIN type_de_frais tf ON nf.id_frais = tf.id_frais";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<div class='card'><div class='card-body'><h5 class='card-title'>Date: {$row['date_facture']}</h5><p class='card-text'>Montant: {$row['montant_facture']}</p><p class='card-text'>Lieu: {$row['lieu_facture']}</p></div></div>";
                    }

                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

                // Fermer la connexion à la base de données
                $pdo = null;
              ?>
            </ul>
          </div>
        </div>


        <form method="POST" action="add_user.php" class="top-left" style="height: 50%; width: 50%;"> 
          <h3><center>Ajouter un utilisateur</center></h3>
          <p>Identifiant : </p> <input type="text" name="id">
          <p> Email : </p> <input type="text" name="email"> 
          <p>Mot de passe : </p><input type="password" name="mdp">
          <p>Statut : </p> <input type="text" name="role">
          <center><button class="bn1" type="submit">Ajouter</button></center>
        </form>

        <div>
          <?php     
            // Vérifier si un message de succès est défini dans la session
            if (isset($_SESSION['success_message'])) {
                // Afficher le message de succès
                echo "<p>" . $_SESSION['success_message'] . "</p>";
    
                // Supprimer le message de la session pour qu'il ne s'affiche plus après un rafraîchissement de la page
                unset($_SESSION['success_message']);
            }
          ?>
        </div>

        <div class="bottom-left" style="height: 50%; width: 50%;">
          <h3><center>Liste des utilisateurs</center></h3>
          <div class="note">
            <ul>
                <?php
                // Informations d'identification
                $serveur = "vitalab-new-gen.mysql.database.azure.com";
                $dbname = "vitalab-new-gen";
                $user = "albinrvi";
                $pass = "Ari69.008";

                // Initialiser la variable qui contiendra la liste des utilisateurs
                $liste_utilisateurs_html = '';

                try {
                    // Connexion à la base de données
                    $dsn = "mysql:host=$serveur;dbname=$dbname";
                    $pdo = new PDO($dsn, $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Exécuter la requête SQL pour récupérer le nom de l'utilisateur et son rôle
                    $sql = "SELECT u.nom_utilisateur, r.nom_role 
                    FROM utilisateur u 
                    INNER JOIN role r ON u.id_role = r.id_role";
                    $stmt = $pdo->query($sql);

                    // Afficher les résultats
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $liste_utilisateurs_html .= "<div class='card'>";
                      $liste_utilisateurs_html .= "<div class='card-body'>";
                      $liste_utilisateurs_html .= "<h5 class='card-title'>" . $row['nom_utilisateur'] . "</h5>";
                      $liste_utilisateurs_html .= "<p class='card-text'>Role: " . $row['nom_role'] . "</p>";
                      $liste_utilisateurs_html .= "</div>";
                      $liste_utilisateurs_html .= "</div>";
                      echo $liste_utilisateurs_html;
                  }

                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

                // Fermer la connexion à la base de données
                $pdo = null;
                ?>
            </ul>
          </div>
        </div>
    </nav>

</body>
</html>