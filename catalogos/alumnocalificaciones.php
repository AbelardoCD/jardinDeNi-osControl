<?php
session_start();
if (!isset($_SESSION['conectado']) == 'true') {
    header("Location: ../registro.php");
}
?>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Nuestro mundo</title>
    <script src="../js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='../js/jquery.validate.js'></script>

    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/main.css" rel="stylesheet" type="text/css" />

    <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>

    <script type='text/javascript' src='../js/nuestro_mundo/alumnocalificaciones.js'></script>

</head>

<body>

    <?php 

    if (($_SESSION['id_tipo_usuario']) == '1')
    {
         include( '../menu.php');  //para el admin
    }else{
        include( '../menu_tutor.php'); //para el tutor
        
    }   
    ?>

      <table width="1098" id="divHeader" class="auto-style3">
      
      <!-- Tipo usuario = php echo  $_SESSION['id_tipo_usuario']; ?> -->
      
      
      <input type="hidden" id="spnIdTutor" value="<?php echo $_SESSION['id_tutor']; ?>"></input>
      <span id="spnNombreTutor" class="label label-default"></span>
      <input type="hidden" id="spnIdTipoUsuario"  value="<?php echo $_SESSION['id_tipo_usuario']?>"/>

      <!--<span id="spnIdColegiatura"class="label label-default"><?php echo $_GET['id_colegiatura']; ?></span>-->
   

         
      
     
         
      
      
        </table> 

        <div class="container-fluid" id="div_lista">
        <div class="text-right">



 <?php
    if(($_SESSION['id_tipo_usuario']) == '2'){
        ?>
        <h1>
      
        <label id="lblColegiatura" class="label label-success"></label>
        
        </h1>
    <?php
        }
        ?>
            <h3>
                    <label class="label label-default">Boletas</label>
                </h3>
            <div class="barra-verde">
       
            </div>
        </div>
        

        <table class="table table-bordered table-hover" id="tablaRegistros">
            <thead> 
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Fecha Nacimiento</th>
                <th>Tipo de sangre</th>
                <th>CURP</th>
                <th>Dirección</th>
              
                <?php
                
                    if(($_SESSION['id_tipo_usuario']) == '1'){

                ?>

                        <th colspan="2">
                           <!-- <button id="btnNuevoRegistro" class="form-control btn btn-info">Nuevo</button>-->
                        </th>
                
                <?php

                    }
                ?>

                
                </tr>
            </thead>

            <tbody>
                


            </tbody>

        </table>

                         <?php
     if(($_SESSION['id_tipo_usuario']) == '2'){
        ?>
       
       <div class="panel panel-success">
        <div class="panel-heading">
        <h1 class="panel-title">RECADOS</h1>
        </div>
        <div id="txtComunicado" class="panel-body">
           
        </div>
        </div>
    
      <?php
        }
        ?>
            
    </div>

    
        <!--este codigo sale sobrando-->
    <div class="container-fluid" id="div_form">

        <div class="text-right">
            <h3>
                    <label class="label label-default"></label>
                </h3>
            <label>Edición</label>
            <div class="barra-verde">

            </div>
        </div>



        <div class="separacion"></div>

        <form id="frmDatos">
            
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombres del alumno">
            </div>
            <div class="form-group">
                <label for="txtApellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" id="txtApellido_paterno" name="txtApellido_paterno" placeholder="En forma Apellido paterno ">
            </div>

             <div class="form-group">
                <label for="txtApellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" id="txtApellido_materno" name="txtApellido_materno" placeholder="En forma Apellido materno">
            </div>
              <div class="form-group">
                <label for="txtFechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="Fecha de nacimiento">
            </div>

              <div class="form-group">
                <label for="txtTipoSangre">Tipo de Sangre</label>
                <input type="text" class="form-control" id="txtTipoSangre" name="txtTipoSangre" placeholder="Tipo de Sangre">
            </div>

            <div class="form-group">
                <label for="txtCurp">CURP</label>
                <input type="text" class="form-control" id="txtCurp" name="txtCurp" placeholder="Curp">
            </div>
                
            <div class="form-group">
                <label for="txtDireccion">Dirección</label>
                <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion">
            </div>
        

         <div class="form-group">
                <label for="comboTutor">Tutor</label>
                <select id="comboTutor" name="comboTutor" class="form-control" >
                </select>

            </div>
         


            <label id="btnCancelar" class="btn btn-info">Cancelar</label>
            <label id="btnGuardar" class="btn btn-success">Guardar</label>
        </form>
    </div>
</body>

 
 <!-- //dialogo de confirmacion -->
<div id="panelConfirm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center"><label id="lblTituloConfirm"></label> </h4>
                </div>
                <div class="modal-body">
                    <p>
                        <label id="lblMensajeConfirm"></label>                                                   
                    </p>
                </div>
                <div class="modal-footer">
                    <button id="btnCancelarEliminar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="btnAceptarEliminar" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
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
    
    
</html>