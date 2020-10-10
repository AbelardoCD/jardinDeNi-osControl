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

    <script type='text/javascript' src='../js/nuestro_mundo/alumnoprimero.js'></script>

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
      
      
      <span id="spnIdTutor"class="label label-default"><?php echo $_SESSION['id_tutor']; ?></span>
      <span id="spnIdGrupo"class="label label-default"><?php echo $_GET['idGrupo']; ?></span>
      
      
      <span id="spnNombreTutor" class="label label-default"></span>
      
        </table> 

        <div class="container-fluid" id="div_lista">
        <div class="text-right">
            <h3>
                    <label id="lblNombreGrupo" class="label label-default"></label>
                </h3>
            <div class="barra-verde">

            

            </div>
        </div>

        <table class="table table-bordered table-hover" id="tablaRegistros">
            <thead> 
                <tr>
                <th>Id</th>
                <th>Nombre Alumno</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>                
                <th>Curp</th>                
                <th>Grado</th>
                <th>Grupo</th>
               
                
                
                
               
                
               
                
                <th colspan="3">
                    <button id="btnNuevoRegistro" class="form-control btn btn-info">Agregar alumno a grado</button>
                </th>
                </tr>
            </thead>

            <tbody>
                


            </tbody>

        </table>

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
                <label for="comboAlumno">Alumno</label>
                <select id="comboAlumno" name="comboAlumno" class="form-control" >
                </select>

            </div>
        <!--<div class="form-group">
                <label for="comboGrado">Grado</label>
                <select id="comboGrado" name="comboGrado" class="form-control" >
                </select>

            </div>-->
            
            <!-- <div class="form-group">
                <label for="comboGrupo">Grupo</label>
                <select id="comboGrupo" name="comboGrupo" class="form-control" >
                </select>

            </div> -->
           
        
         
         


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
    
 <!-- //dialogo de calificacion -->
 <div id="panelCalificacion" class="modal fade" role="dialog">
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
                        <form id="frmDatos">


            <div class="form-group">
                <label for="txt1">Mate</label>
                <input type="text" class="form-control" id="txt1" name="txt1" placeholder=" calificacion">
            </div>

              <div class="form-group">
                <label for="txt2">Pensamiento Matematico</label>
                <input type="text" class="form-control" id="txt2" name="txt2" placeholder=" calificacion">
            </div>

            <div class="form-group">
                <label for="txt3">Exploración y Conocimiento del Mundo</label>
                <input type="text" class="form-control" id="txt3" name="txt3" placeholder=" calificacion">
            </div>

            <div class="form-group">
                <label for="txt4">Desarrollo Personal y Social</label>
                <input type="text" class="form-control" id="txt4" name="txt4" placeholder=" calificacion">
            </div>

             <div class="form-group">
                <label for="txt5">Expresion y Apreciación Artisticas </label>
                <input type="text" class="form-control" id="txt5" name="txt5" placeholder=" calificacion">
            </div>


               <div class="form-group">
                <label for="txt6">Desarrollo Fisico y Salud</label>
                <input type="text" class="form-control" id="txt6" name="txt6" placeholder=" calificacion">
            </div>

             <div class="form-group">
                <label for="comboEtapa">Etapa</label>
                <select id="comboEtapa" name="comboEtapa" class="form-control" >
                </select>

            </div>
            

             <div class="form-group">
                <label for="comboExtracurricular">Extracurricular</label>
                <select id="comboExtracurricular" name="comboExtracurricular" class="form-control" >
                </select>

            </div>



            <div class="form-group">
                <label for="txtCalificacionExtracurricular">Calificacion Exracurricular</label>
                <input type="text" class="form-control" id="txtCalificacionExtracurricular" name="txtCalificacionExtracurricular" placeholder="Calificacion">
            </div>


                </select>

                </form>                                                
                    </p>
                </div>
                
                </select>

            </div>
                <div class="modal-footer">
                    <button id="btnCancelarGuardar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="btnAceptarGuardar" type="button" class="btn btn-default" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
   
   
    <!--Colegiatura-->


    <div id="panelColegiatura" class="modal fade" role="dialog">
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
                        <form id="frmDatos">


           <div class="form-group">
                <label for="txtFechaPago">Fecha Pago</label>
                <input type="date" class="form-control" id="txtFechaPago" name="txtFechaPago" placeholder=" Fecha Pago">
            </div>

              <div class="form-group">
                <label for="txtFechaPagado">Fecha Pagado</label>
                <input type="date" class="form-control" id="txtFechaPagado" name="txtFechaPagado" placeholder=" Fecha Pagado">
            </div>

            <div class="form-group">
                <label for="txtMonto">Monto</label>
                <input type="text" class="form-control" id="txtMonto" name="txtMonto" placeholder="$">
            </div>

          
                </select>

                </form>                                                
                    </p>
                </div>
                
                </select>

            </div>
                <div class="modal-footer">
                    <button id="btnCancelarGuardar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="btnAceptarGuardarColegiatura" type="button" class="btn btn-default" data-dismiss="modal">Guardar</button>
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