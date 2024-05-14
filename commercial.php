<?php
session_start();
if (!isset($_SESSION['id_utilisateur'])  || $_SESSION['id_utilisateur'] == null){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="commercial.css"/>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <nav class="navbar">

        <div class="container1"> 
          <img src="images/logo.png" alt="Bootstrap" class="img-nav">    
        </div>

        <center><p><h3 style="letter-spacing: 5px;">Vitalab New Gen</h3></p></center>

        <div class="dropdown">
          <button href="" class="btn41-43 btn-42" onclick="logoutcm()">Déconnexion</button>
          <script>
            //Fonction pour se déconnecter
            function logoutcm() {
              window.location.href = "index.php";
            }
            </script>
        </div>
    </nav>

    <nav class="container2">
        <div class="bottom" >
          <h3><center>Liste notes de frais</center></h3>
          <center><hr></center>
          <div class="note-countainer">
            <table id="myTable" class="display">
              <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Id de la note de frais</th>
                    <th>Date de facture</th>
                    <th>Montant</th>
                    <th>Lieu</th>
                    <th>Type de frais</th>
                    <th>Statut</th>
                    <th>Actions</th> <!-- Ajout de la colonne Actions -->
                </tr>
              </thead>
              <tbody>
                <?php
                    // Informations d'identification
                    $serveur = "vitalab-new-gen.mysql.database.azure.com";
                    $dbname = "vitalab-new-gen";
                    $user = "albinrvi";
                    $pass = "Ari69.008";                    
                    
                    // On récupère l'id de l'utilisateur connecté
                    if (isset($_SESSION['id_utilisateur'])) {
                      $id_utilisateur_connecte = filter_var($_SESSION['id_utilisateur'], FILTER_VALIDATE_INT);
                    } else {
                      // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
                      header("Location: login.php");
                      exit();
                    }
          
                    try {
                        // Connexion à la base de données
                        $dsn = "mysql:host=$serveur;dbname=$dbname";
                        $pdo = new PDO($dsn, $user, $pass);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Requête SQL pour récupérer les notes de frais de l'utilisateur connecté
                        $sql = "SELECT n.date_facture, n.montant_facture, n.lieu_facture, f.type_frais, n.statut, n.id_note_de_frais, n.intitule
                        FROM note_de_frais n 
                        INNER JOIN type_de_frais f ON n.id_frais = f.id_frais
                        WHERE n.id_utilisateur = :id_utilisateur";
                        $req = $pdo->prepare($sql);
                        $req->bindParam(':id_utilisateur', $id_utilisateur_connecte, PDO::PARAM_INT);
                        $req->execute();

                        // Afficher les notes de frais sous forme de cartes
                        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($row['intitule']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['id_note_de_frais']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['date_facture']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['montant_facture']) . " € </td>";
                          echo "<td>" . htmlspecialchars($row['lieu_facture']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['type_frais']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['statut']) . "</td>";
                      
                          // Vérifiez le statut pour afficher ou non le bouton "Supprimer"
                          if ($row['statut'] == "En attente" || $row['statut'] == "en attente") {
                              echo "<td>";
                              echo "<form method='post' action='delete_ndf.php'>";
                              echo "<input type='hidden' name='id_note_de_frais' value='" . htmlspecialchars($row['id_note_de_frais']) . "' />";
                              echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                              echo "</form>";
                              echo "</td>";
                          } else {
                              echo "<td></td>"; // Ajouter une cellule vide si le statut n'est pas "En attente"
                          }
                      }
                //Gestion des erreurs
                } catch (PDOException $e) {echo "Erreur : " . $e->getMessage();}

                // Fermer la connexion à la base de données
                $pdo = null;
                ?>
              </tbody>
            </table>
          <div>
            <?php     
              // Vérifier si un message de succès est défini dans la session
              if (isset($_SESSION['delete_ndf'])) {
                  // Afficher le message de succès
                  echo "<center><p>" . $_SESSION['delete_ndf'] . "</p></center>";
                  // Supprimer le message de la session pour qu'il ne s'affiche plus après un rafraîchissement de la page
                  unset($_SESSION['delete_ndf']);}
            ?>
            </div>
          </div>
        </div>

        <div class="left">
          <form method="POST" action="add_ndf.php" enctype="multipart/form-data"> 
              <h3><center>Ajouter note de frais</center></h3>
              <center><hr></center>
              <p>Intitulé : </p><input type="text" name="intitule">
              <p>Date : </p><input type="text" name="date">
              <p>Montant : </p><input type="number" name="montant">
              <p>Lieu : </p><input type="text" name="lieu">
              <p>Id Frais : </p><input type="number" name="id_frais">
              <p>Ajouter une image : </p><input type="file" name="image">
              <center><button class="bn1" type="submit">Ajouter</button></center>
              <?php
                // Vérifier si un message de succès est défini dans la session
                if (isset($_SESSION['ajout_ndf'])) {
                  // Afficher le message de succès
                  echo "<p>" . $_SESSION['ajout_ndf'] . "</p>";
                  // Supprimer le message de la session pour qu'il ne s'affiche plus après un rafraîchissement de la page
                  unset($_SESSION['ajout_ndf']);}
              ?>
          </form>
        </div>


        <div class="right" >
            <form method="POST" action="modif_ndf.php" > 
              <h3><center>Modifier une note de frais</center></h3>
              <center><hr></center>
              <center><p>Id de la note à modifier : </p><input type="text" name="id_modif"></center>
              <center><p>Intitulé : </p><input type="text" name="intitule"></center>
              <center><p>Date : </p><input type="text" name="date"></center>
              <center><p>Montant : </p><input type="number" name="montant"></center>
              <center><p>Lieu : </p><input type="text" name="lieu"></center>
              <center><p>Id Frais : </p><input type="number" name="id_frais"></center>
              <center><p>Modifier une image : </p><input type="file" name="image"></center>
              <center><button class="bn1" type="submit">Modifier</button></center>
              <?php
                // Vérifier si un message de succès est défini dans la session
                if (isset($_SESSION['modif_ndf'])) {
                  // Afficher le message de succès
                  echo "<p>" . $_SESSION['modif_ndf'] . "</p>";
                  // Supprimer le message de la session pour qu'il ne s'affiche plus après un rafraîchissement de la page
                  unset($_SESSION['modif_ndf']);}
              ?>
            </form>
        </div>
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.display').DataTable({
                pagingType: 'full',
                scrollY: '400px', // Définissez la hauteur de la zone de défilement
                scrollCollapse: true, // Permettez à la zone de défilement de s'effondrer lorsque le contenu est inférieur à la hauteur définie
                paging: true // Activez la pagination
            });
        });
    </script>

</body>
</html>
