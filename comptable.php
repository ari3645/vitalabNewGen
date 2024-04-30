<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalab App</title>
    <link rel="stylesheet" type="text/css" href="comptable.css"/>
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
          <button href="" class="btn41-43 btn-42" onclick="logoutcp()">
            Déconnexion
          </button>

          <script>
            function logoutcp() {
              window.location.href = "index.php";
            }
            </script>
        </div>
    </nav>
    <nav class="container2">
        <div class="right" >
          <h3><center>Liste notes de frais</center></h3>
          <div class="note">
            <div class="row">
              <div class="col-md-4">
                  <h4>Nom</h4>
              </div>
              <div class="col-md-4">
                  <h4>Intitulé</h4>
              </div>
              <div class="col-md-4">
                  <h4>Frais</h4>
              </div>
          </div>
          </div>
          
        </div>
        <div class="extreme-gauche">
            <div class="left" >
              <h3><center>Informations note de frais</center></h3>
              <h5>Intitulé : </h5>
              <h5> Frais : </h5>
              <h5>Date : </h5>
              <h5> Détails : </h5>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="" class="bn1" >Accepter</a>
                </div>
                <div class="col-md-3">
                    <a href="" class="bn1" >Refuser</a>
                </div>
                <div class="col-md-6">
                    
                </div>
                
            </div>
        </div>
    </nav>


</body>
</html>