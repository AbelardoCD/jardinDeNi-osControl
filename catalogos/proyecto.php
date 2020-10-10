<?php
session_start();
if (!isset($_SESSION['conectado']) == 'true') {
    header("Location: ../registro.php");
}

?>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Aplicación contable</title>
    <script src="../js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='../js/jquery.validate.js'></script>

    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/main.css" rel="stylesheet" type="text/css" />

    <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>

    <script type='text/javascript' src='../js/sdc/proyecto.js'></script>

</head>

<body>

    <?php include( '../menu.php'); ?>

    
      <table width="1098" id="divHeader" class="auto-style3">
            <tbody>
                <tr height="0">
                    <td width="236">
                        <img src="../images/SHCP_horizontal_color.jpg" height="60" width="200">
                    </td>
                    <td width="253">
                        <img src="../images/logoH_col.jpg" height="60" width="200">
                    </td>
                    <td width="130">
                        <br>
                    </td>
                    <td colspan="3" align="right" width="459">
                        <p>&nbsp;</p>
                        <p>Administración Central de Planeación, Análisis e Información.
                            <br>Administración de Planeación, Análisis e Información "5".
                            <br>Subadministración de Procedimientos Contables.</p>
                        <h2><b><b> Aplicación Contable</b></b></h2>
                    </td>
                </tr>
            </tbody>
        </table> 

        <div class="container-fluid" id="div_lista">
        <div class="text-right">
            <h3>
                    <label class="label label-default">SDC</label>
                </h3>
            <div class="barra-verde">

            </div>
        </div>

        <table class="table table-bordered table-hover" id="tablaRegistros">
            <thead <tr>
                <th>Id</th>
                <th>Concepto proyecto</th>
                <th colspan="2">
                    <button id="btnNuevoRegistro" class="form-control btn btn-info">Nuevo</button>
                </th>
                </tr>
            </thead>

            <tbody>
                


            </tbody>

        </table>

    </div>

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
                <label for="txtIdproyecto">Id proyecto</label>
                <input type="number" class="form-control" id="txtIdproyecto" name="txtIdproyecto" placeholder="Id proyecto">
            </div>
            <div class="form-group">
                <label for="txtConceptoproyecto">Concepto proyecto</label>
                <input type="text" class="form-control" id="txtConceptoproyecto" name="txtConceptoproyecto" placeholder="Concepto proyecto">
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