<?php 
// echo "test";
// $serveur = "vitalab-new-gen.mysql.database.azure.com";
// $dbname = "vitalab-new-gen";
// $user = "albinrvi";
// $pass = "Ari69.008";

// $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
// $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Récupère les données du formulaire
//     $login = $_POST["id"];
//     $password = $_POST["password"];

//     try{

//         //On vérifie si le login existe déjà et si le mot de passe correspond
//         $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE Nom_utilisateur = :login AND MDP = :password");
//         $sth->bindParam('login',$login);
//         $sth->bindParam('password',$password);
//         $sth->execute();
//         $count = $sth->rowCount();
//         $role = $sth->fetchColumn(4);
//         if($count == 1 and $role == '1'){
//             echo 'Connexion réussie admin';
//            header("Location:admin.html");
//         }else if ($count == 1 and $role == '2'){
//             echo 'Connexion réussie comptable';
//             header("Location:comptable.html");
//         }else if ($count == 1 and $role == '3'){
//             echo 'Connexion réussie commercial';
//            header("Location:commercial.html");
//         }else{
//             echo 'Mauvais identifiants';
//             // Faire en sorte qu'on revienne sur la page HTML avec un message d'erreur   
//             header("Location:testh.html"); 
//         }
         
//         }
//         catch(PDOException $e){
//             echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
//         }
// }
//

// <!DOCTYPE html>
// <html lang="fr">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Vitalab App</title>
//     <link rel="stylesheet" type="text/css" href="formulaire.css"/>
//     <link rel="icon" href="#">
//     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
// </head>
// <body>
    
//     <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    
 //     <div class="card">

//         <center><img src="images/logo.png" class="img-com-so" style="width: 18rem;"></center>
//         <p>&nbsp;</p>
//         <p>Identifiant</p>
//         <input type="text">
       
//         <p>Mot de passe</p>
//         <input type="password">
        
//         <center><a href="" class="bn1">Connexion</a></center>
//     </div>
// </body>
// </html> --> -->
?>

<?php
// $serveur = "vitalab-new-gen.mysql.database.azure.com";
// $dbname = "vitalab-new-gen";
// $user = "albinrvi";
// $pass = "Ari69.008";

// $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
// $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Récupère les données du formulaire
//     $login = $_POST["login"];
//     $password = $_POST["password"];

//     try {
//         //On vérifie si le login existe déjà et si le mot de passe correspond
//         $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE Nom_utilisateur = :login AND MDP = :password");
//         $sth->bindParam('login', $login);
//         $sth->bindParam('password', $password);
//         $sth->execute();
//         $count = $sth->rowCount();
//         $role = $sth->fetchColumn(4);
//         if ($count == 1 and $role == '1') {
//             header("Location:admin.html");
//             exit;
//         } else if ($count == 1 and $role == '2') {
//             header("Location:comptable.html");
//             exit;
//         } else if ($count == 1 and $role == '3') {
//             header("Location:commercial.html");
//             exit;
//         } else {
//             // Rediriger vers la page de connexion avec un message d'erreur
//             header("Location:testh.html");
//             exit;
//         }
//     } catch (PDOException $e) {
//         echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
//     }
// }
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
        <form method="post" action=""> <!-- Ajout de la balise form -->
            <p>&nbsp;</p>
            <p>Identifiant</p>
            <input type="text" name="login"> <!-- Ajout de l\'attribut name -->
            <p>Mot de passe</p>
            <input type="password" name="password"> <!-- Ajout de l\'attribut name -->
            <center><button type="submit" class="bn1">Connexion</button></center> <!-- Remplacement du lien a par un bouton de type submit -->
        </form>
    </div>'; ?>

</body>

</html>