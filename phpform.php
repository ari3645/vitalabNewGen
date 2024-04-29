<?php  

echo "test";


$serveur = "localhost";
$dbname = "compta_frais";
$user = "root";
$pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $login = $_POST["id"];
    $password = $_POST["password"];
    
        
    // Exemple d'affichage des données traitées
    echo "id: " . $login. "<br>";
    echo "mdp: " . $password;
    }

    try{

        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On vérifie si le login existe déjà et si le mot de passe correspond
        $sth = $dbco->prepare("SELECT * FROM utilisateur WHERE Nom_utilisateur = :login AND MDP = :password");
        $sth->bindParam('login',$login);
        $sth->bindParam('password',$password);
        $sth->execute();
        $count = $sth->rowCount();
        $role = $sth->fetchColumn(4);
        if($count == 1 and $role == '1'){
            echo 'Connexion réussie admin';
           header("Location:admin.html");
        }else if ($count == 1 and $role == '2'){
            echo 'Connexion réussie comptable';
            header("Location:comptable.html");
        }else if ($count == 1 and $role == '3'){
            echo 'Connexion réussie commercial';
           header("Location:commercial.html");
        }else{
            echo 'Mauvais identifiants';
            // Faire en sorte qu'on revienne sur la page HTML avec un message d'erreur   
            header("Location:testh.html"); 
        }
         
        }
        catch(PDOException $e){
            echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
        }
    
?>