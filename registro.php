<?php
//session_start();
//if (isset($_SESSION['conectado']) == 'true') {
//    header("Location: principal.php");
//}


include("conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "Aplicación contable";


?>

<html>
    <head>
      

    
     
        <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script type='text/javascript' src='js/jquery.validate.js'></script> 

        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>

        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

        <!--<link rel="icon" type="image/png" href="imagenes/l.png" sizes="128x128" />-->

    <script type='text/javascript' src='js/nuestro_mundo/login.js'></script>
    </head>
    <body>

 
    <div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-success" >
                <div class="panel-heading">
                    <div class="panel-title">Login</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#"></a></div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        
                    <form name="loginform"  id="loginform" class="form-horizontal" >
                                
                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  type="text" class="form-control" id="username" value="" placeholder="Nombre de usuario">                                        
                                </div>
                            
                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input  type="password" class="form-control" id="password" placeholder="Contraseña">
                                </div>


                            <div style="margin-top:10px" class="form-group">
                            

                                <div class="col-sm-12 controls">
                                  <a id="btn-login" href="#" class="btn btn-success">Login  </a>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <label  id="lblMsgError" class="label label-warning">No se encontró usuario y contraseña.</label>
                                </div>                                           
                                    
                            </div>
                              
                        </form>     



                    </div>                     
                </div>  
    </div>
  
  </div>
 
            
                                

</html>

