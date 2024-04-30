<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="commercial.css"/>
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
          <button href="" class="btn41-43 btn-42" onclick="logoutcm()">
            Déconnexion
          </button>

          <script>
            function logoutcm() {
              window.location.href = "index.php";
            }
            </script>
        </div>
    </nav>
    <nav class="container2">
        <div class="right" >
          <h3><center>Liste notes de frais</center></h3>
          <div class="note">
            <p>Intitulé</p>
            <a href="" class="bn1" >Supprimer</a>
          </div>
          
        </div>
        <div class="top-left" style="height: 50%; width: 50%;">
          <h3><center>Ajouter note de frais</center></h3>
          <p>Intitulé</p>
          <input type="text">
          
          <p>Frais</p>
          <input type="text">
          <center><a href="" class="bn1">Ajouter</a></center>
        </div>
        <div class="bottom-left" style="height: 50%; width: 50%;">
          <h3><center>Modifier note de frais</center></h3>
          <p>Intitulé</p>
          <input type="text">
          
          <p>Frais</p>
          <input type="text">
          <center><a href="" class="bn1">Enregistrer</a></center>
        </div>
    </nav>


</body>
</html>