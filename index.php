<?php
session_start();
if (!isset($_SESSION['conectado']) == 'true') {
   // header("Location: ../../../login/nuestromundo/catalogos/indexcomunicados.php");
}
?>
<html lang="es">

<head>
<meta charset="utf-8">
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Colegio</title>
    <!-- Required meta tags -->   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='js/jquery.validate.js'></script>

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet" type="text/css" />

    <script src="js/bootstrap.js" type="text/javascript"></script>

    <script type='text/javascript' src='js/nuestro_mundo/indexcomunicados.js'></script>
    <script  src='js/validator.js'></script>

     <!--Estilo para la imagen de fondo-->
     <style>
        .slider{
            background: url("images/playaatardecer.jpg");
            background-size: cover;
            backgroud-position: center;
            height: 400px;
        }
    </style>

</head>

<body>


<!--Menu-->
<div class="container-fluid bg-inverse fixed-top text-center bg-dark">
       <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
          <a class="navbar-brand" href="index.html">
          <img src="images/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">  Jardin de niños
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ml-auto">
              <a class="nav-item nav-link active" href="indexcomunicados.php">Inicio <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="instalaciones.html ">Instalaciones </a>
              <a class="nav-item nav-link" href="informacion.html">Información </a>
              <a class="nav-item nav-link mr-md-4" href="registro.php">Perfil</a>
              <div><a href="catalogos/contacto.php" class="btn btn-danger">Contacto</a></div>
            </div>
          </div>
        </nav>
       </div>
        <!--Fin de menu-->


            <!--Inicio slider fondo-->
            <div class="container-fluid slider d-flex justify-content-center align-items-center flex-colum">
           <div class="text-center text-white">
             <h1>Colegio</h1>
             <h2 class="display">Jardin de Niños</h2>
            </div>
        </div>


         <!--Actualizaciones-->
       
       <!--Carrusel de imagenes -->
       <br><br>
       <div class="container">
       <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
       <br>        
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img class="d-block w-100" src="images/act1.jpg" alt="First slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act2.jpg" alt="Second slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act3.jpg" alt="Third slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act4.jpg" alt="Four slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act1.jpg" alt="Five slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act2.jpg" alt="Six slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act3.jpg" alt="Seven slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/act2.jpg" alt="Eight slide" width="600" height="400">
              <h4 class="display text-center text-dark">Actividades recientes</h4>
            </div>
          </div>

          <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
        <br><br>
        <!--Fin de las actualizaciones-->
        
         
 
         <!--Comunicados-->
         <div class="container">
          <!--<h1>Comunicados en general</h1>
          <p id="txtMensaje"></p>-->
          <div class="jumbotron">
  <h1 class="display-4">Comunicados Generales</h1>
  <p class="lead" id="txtMensaje"></p>
  <hr class="my-4">
  <p>VISITANOS</p>
  
</div>
        </div>
          






        <!--Fin de los comunicados-->
        <!--Main-->
        <div class="container">           
           <div class="row">
              <!--Articulos--> 
              <div class="col-sm-4">
               <!--Articulo 1-->    
                    <img src="images/vision1.jpg" width="350" height="350" class="img-fliud responsive">
                    <h4 class="lead text-center text-dark">Visión</h4>
                    <p class="lead text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>   
                </div>
               <!--Fin Articulo 1--> 
               
               <!--Articulo 2--> 
               <div class="col-sm-4">
                    <img src="images/mision1.jpeg" width="350" height="350" class="img-fliud">
                    <h4 class="lead text-center text-dark">Misión</h4>
                    <p class="lead text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>                         
                   </div>
               <!--Fin Articulo 2--> 
               <div class="col-sm-4">
               <!--Articulo 3--> 
                    <img src="images/filosofia1.jpg" width="350" height="350" class="img-fliud">
                    <h4 class="lead text-center text-dark">Filosofia</h4>
                    <p class="lead text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>               
                </div>
               <!--Fin Articulo 3-->                
              <!--Fin de artiuclos-->                                  
            </div>
        </div>
        <!--Fin del main-->
        <!--Footer-->
        <footer class="container-fluid bg-dark text-center py-3 text-white">
           <a href="#" title="Facebook"><img src="images/logo-facebook.png" alt="Responsive image" width="80" height="50"></a>  <p>Copyright 2018 &copy; Jardín de niños</p>                 
        </footer>
        <!--Fin del footer-->
</body>
</html>