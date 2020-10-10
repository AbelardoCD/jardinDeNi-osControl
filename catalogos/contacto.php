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
    <title>Nuestro mundo</title>
    <!-- Required meta tags -->   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="../js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='../js/jquery.validate.js'></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
    <link href="../css/main.css" rel="stylesheet" type="text/css" />

    <script src="../js/bootstrap.js" type="text/javascript"></script>

    <script type='text/javascript' src='../js/nuestro_mundo/contacto.js'></script>
    <script  src='../js/validator.js'></script>

     <!--Estilo para la imagen de fondo-->
     <style>
        .slider{
            background: url("../images/playaatardecer.jpg");
            background-size: cover;
            backgroud-position: center;
            height: 400px;
        }
    </style>

</head>

<body>
 

<!--Menu-->     
<div class="container-fluid bg-inverse fixed-top text-center bg-dark" >
       <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
          <a class="navbar-brand" href="index.html">
          <img src="../images/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">  Jardin de niños
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="navbar-nav ml-auto" >
              <a class="nav-item nav-link active" href="../index.php">Inicio <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="../instalaciones.html ">Instalaciones </a>
              <a class="nav-item nav-link" href="../informacion.html">Información </a>
              <a class="nav-item nav-link mr-md-4" href="../registro.php">Perfil</a>
              <div><a href="contacto.php" class="btn btn-danger">Contacto</a></div>
            </div>
          </div>
        </nav>
       </div>
        <!--Fin de menu-->


     <div class="container">
                  <h4>empresa</h4>
                  <div class="container"><br><br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d942.2604421379165!2d-96.9730276708395!3d19.149648866085343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c4dc7867b15cc5%3A0x4306d987aefe0925!2sJardin+De+Ni%C3%B1os+%22Nuestro+Mundo%22!5e0!3m2!1ses!2smx!4v1524236496636" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                  </div>

<!--Fin del main-->
                            
    <div class="container-fluid" id="div_form">

            <div class="text-right">
            <h3>
            <label class="label label-default"></label>
        </h3>
         <label>Dudas</label>
      <div class="barra-verde">

        </div>
        </div>



       <div class="separacion"></div>

        <form id="frmDatos" role="form" name="frmDatos" data-toggle="validator">
    
    


       <h3>Dudas o sugerencias, escribenos. </h3>
       <div class="form-group">
       
        <label class="col-sm-4 col-form-label">Mensaje</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="txtMensaje" name="Mensaje" placeholder="Mensaje"  />
        <div class="help-block with-errors"></div>
      </div>
      </div>
    

     <div class="form-group">
       
       <label class="col-sm-4 col-form-label">Email</label>
       <div class="col-sm-8">
       <input type="text" class="form-control" id="txtCorreo" name="El correo electronico es incorrecto,debe respetar el formato."  title=""   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  placeholder="Ingrese su correo para resivir nuestra respuesta." data-pattern-error="El correo electronico es incorrecto,debe respetar el formato" id="txtCorreo" required data-required-error='Requerido'/>
       <div class="help-block with-errors"></div>
     </div>
     </div>
   
    
    

        




    
      <label id="btnEnviar" class="btn btn-success">Enviar</label>
      </form>
   </div>



<!-- dialogo de informacion -->
<div id="panelInfo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center"><label id="lblTituloInfo"></label> </h4>
                </div>
                <div class="modal-body">
                    <p>
                        <label id="lblMensajeInfo"></label>                                                   
                    </p>
                </div>
                <div class="modal-footer">
                <button id="btnAceptar" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    
     

  </body>
   </html>