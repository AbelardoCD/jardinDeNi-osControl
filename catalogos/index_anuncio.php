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

    <script type='text/javascript' src='../js/nuestro_mundo/index_anuncio.js'></script>
    <script  src='../js/validator.js'></script>

</head>

<body>

     <?php 
    if ((isset($_SESSION['id_tipo_usuario'])) == '1')
    {
         include( '../menu.php');  //para el admin
    }else{
        include( '../menu_tutor.php'); //para el tutor
        
    }   
    ?>
    
      <table width="1098" id="divHeader" class="auto-style3">
            
        </table> 

        <div class="container-fluid" id="div_lista">
        <div class="text-right">
            <h3>
                    <label class="label label-default">Recados</label>
                </h3>
            <div class="barra-verde">

            </div>
        </div>

        <table class="table table-bordered table-hover" id="tablaRegistros">
            <thead> 
                <tr>
                <th>Id</th>
                <th>Anuncio</th>
                
                
                
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

         <form id="frmDatos" role="form" name="frmDatos" data-toggle="validator">
            
            
        


            <div class="form-group">
                <label class="col-sm-4 col-form-label">Anuncio</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="txtAnuncio" name="txtAnuncio" placeholder="Anuncio" required data-required-error='Requerido' />
                <div class="help-block with-errors"></div>
            </div>
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