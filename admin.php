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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  </head>
<body>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            // Initialiser DataTable sur les tables avec la classe "dataTable"
            $('#myTable').DataTable({
              pagingType: 'full', //Ajoute les boutons de navigation (premier, précédent, suivant, dernier)
              scrollY: '400px', //Hauteur de la zone de défilement
              scrollCollapse: true, //Réduire la hauteur si moins de lignes
              paging: true //Activer la pagination
            });
        });
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <nav class="navbar">

        <div class="container1"> 
          <img src="images/logo.png" class="img-nav">
        </div>
        <center><p><h3 style="letter-spacing: 5px;">Vitalab New Gen</h3></p></center>

        <div class="dropdown">
          <button href="" class="btn41-43 btn-42" style="padding-right:20%" onclick="logouta()">Déconnexion</button>
          <script>
            //Fonction pour se déconnecter
            function logouta() {
              window.location.href = "index.php";
            }
          </script>
        </div>
    </nav>
    <div class="container2">
      <center>
        <div class="top-left">
            <h3><center>Liste notes de frais</center></h3>
            <hr>
            <div class="note-countainer">
              <table id="myTable" class="display">
                <thead>
                  <tr>
                      <th>Date de facture</th>
                      <th>Montant</th>
                      <th>Lieu</th>
                      <th>Type de frais</th>
                      <th>Statut</th>
                  </tr>
                </thead>
                <tbody>
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
                        $req = "SELECT n.date_facture, n.montant_facture, n.lieu_facture, f.type_frais, n.statut
                        FROM note_de_frais n 
                        INNER JOIN type_de_frais f ON n.id_frais = f.id_frais";
                        $sql = $pdo->prepare($req);
                        $sql->execute();

                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($row['date_facture']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['montant_facture']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['lieu_facture']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['type_frais']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['statut']) . "</td>";
                          echo "</tr>";
                      }

                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }finally{
                        // Fermer la connexion à la base de données
                        $pdo = null;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div>
            <form method="POST" action="add_user.php" class="right" style="height: 50%; width: 50%;"> 
              <h3 class="title"><center>Ajouter un utilisateur</center></h3>
              <hr>
              <p>Identifiant : </p> <input type="text" name="id">
              <p> Email : </p> <input type="text" name="email"> 
              <p>Mot de passe : </p><input type="password" name="mdp">
              <p>Statut : </p> <input type="text" name="role">
              <center><button class="bn1" type="submit">Ajouter</button></center>
            </form>
            <div>
            <?php     
              // Vérifier si un message de succès est défini dans la session
              if (isset($_SESSION['add_user'])) {
                  // Afficher le message de succès
                  echo "<p>" . $_SESSION['add_user'] . "</p>";
      
                  // Supprimer le message de la session pour qu'il ne s'affiche plus après un rafraîchissement de la page
                  unset($_SESSION['add_user']);
              }
            ?>
            </div>
          </div>

          <div class="bottom-left" style="height: 50%; width: 50%;">
            <h3><center>Liste des utilisateurs</center></h3>
            <hr>
            <div class="note-countainer">
              <table id="myTable" class="display">
                <thead>
                  <tr>
                      <th>Nom</th>
                      <th>Role</th>
                      <th>Supprimer</th>
                  </tr>
                </thead>
                <tbody>
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

                        $nom_utilisateur = "SELECT nom_utilisateur FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
                        $nom_utilisateur = $pdo->prepare($nom_utilisateur);
                        $nom_utilisateur->bindParam(':id_utilisateur', $_SESSION['id_utilisateur']);
                        $nom_utilisateur->execute();
                        $nom_user = $nom_utilisateur->fetch(PDO::FETCH_ASSOC);

                        // Exécuter la requête SQL pour récupérer le nom de l'utilisateur et son rôle
                        $req = "SELECT u.nom_utilisateur, r.nom_role 
                        FROM utilisateur u 
                        INNER JOIN role r ON u.id_role = r.id_role";
                        $sql = $pdo->prepare($req);
                        $sql->execute();
                        $row= $sql->fetch(PDO::FETCH_ASSOC);

                        // Afficher les résultats
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                          if ($row['nom_utilisateur'] == $nom_user['nom_utilisateur'] ) {
                            continue;
                          }else {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nom_utilisateur']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nom_role']) . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='delete_user.php'>";
                            echo "<input type='hidden' name='nom_user' value='" . htmlspecialchars($row['nom_utilisateur']) . "' />";
                            echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                          }

                      }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }finally{
                        // Fermer la connexion à la base de données
                        $pdo = null;
                    }?>
                </tbody>
              </table>
            </div>
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
          </div>
      </center> 
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.display').DataTable();
        });
    </script>

</body>
</html>