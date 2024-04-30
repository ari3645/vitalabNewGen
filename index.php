<?php
$serveur = "vitalab-new-gen.mysql.database.azure.com";
$dbname = "vitalab-new-gen";
$user = "albinrvi";
$pass = "Ari69.008";

$dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];



    try {
        //On vérifie si le login existe déjà et si le mot de passe correspond
        $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE Nom_utilisateur = :login AND mot_de_passe = :password");
        $sth->bindParam('login', $login);
        $sth->bindParam('password', $password);
        $sth->execute();
        $count = $sth->rowCount();
        $role = $sth->fetchColumn(4);
        if ($count == 1 and $role == '1') {
            // echo "Connexion admin réussie";
            $_SESSION['id_utilisateur'] = $login;
            header("Location:admin.php");

            exit;
        } else if ($count == 1 and $role == '2') {
            // echo "Connexion comptable réussie";
            $_SESSION['id_utilisateur'] = $login;
            header("Location:comptable.php");
            exit;
        } else if ($count == 1 and $role == '3') {
            // echo "Connexion commercial réussie";
            $_SESSION['id_utilisateur'] = $login;
            // echo $_SESSION['id_utilisateur'];
            header("Location:commercial.php");
            exit;
        } else {
            // Rediriger vers la page de connexion avec un message d'erreur
            header("Location:testh.html");
            exit;
        }
    } catch (PDOException $e) {
        echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="formulaire.css" />
    <link rel="icon" href="#">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php echo '<div class="card">
        <center><img src="images/logo.png" class="img-com-so" style="width: 18rem;"></center>
        <form method="post" action=""> 
            <p>&nbsp;</p>
            <p>Identifiant</p>
            <input type="text" name="login">
            <p>Mot de passe</p>
            <input type="password" name="password"> 
            <center><button type="submit" class="bn1">Connexion</button></center> 
        </form>
    </div>'; ?>

</body>
</html>