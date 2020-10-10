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

    <script type='text/javascript' src='../js/nuestro_mundo/imagenes.js'></script>
    <script  src='../js/validator.js'></script>

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
    
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="panel panel-success">
  <div class="panel-heading">Descargar imagen</div>
  <div class="panel-body">
  En esta sección se muestran imagenes de participaciones que tuvieron los alumnos, por ejemplo desfiles, concursos,etc.</br>      
    1.- Clic derecho sobre la imagen. </br>
    2.- Clic en la opción "Guardar imagen como". </br>
    
    
  </div>
</div>
    </div>
    </div>
    </div>

 

<!--modal-->
	<!-- //dialogo de calificacion -->
	<div id="panelCalificacion" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content" >
				<div class="modal-header" class="barra-verde">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title text-center">
						<label id="lblTituloConfirm" ></label>
					</h4>
				</div>
				<div class="modal-body">
					<p>
						<label id="lblMensajeConfirm"></label>
						<form  action="operaciones_imagenes.php" method="POST" enctype="multipart/form-data">
           <center><table border="1">
            <tr bgcolor="skyblue">        
                <td><strong>Nombre:</strong></td><td> <input type="text" name="txtnom" value=""></td>
            </tr>
            <tr bgcolor="skyblue">
            <td bgcolor="skyblue"><strong>Foto:</strong></td>  <td><input type="file" name="foto" id="foto"></td>
            </tr>
            <tr>
            <td colspan="2" align="center" bgcolor="skyblue"><input type="submit" name="enviar" value="Enviar"></td>
            </tr>
            </center></table>
           
                            
        </form>    
					</p>
				</div>

				</select>

			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	
       
      
               				<?php
                include("../conexion.php");
       $cnx = conectar();
        $consulta= "select * from imagenes";
        $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
       $cfilas = mysql_num_rows($rset);
      
       
        while($res=  mysql_fetch_array($rset)){
            ?>   
         
             <div class="container">
            
             <div class="row">
            
        
                 <div class="col-md-12" style="background-color:#D8DED1">
                     <a href="#" class="thumbnail">
                            <?php echo ' <img src="'.$res["ruta"].'" width="300" heigth="1000" >'; ?> 
	                        
                         <!--   <a href="eliminar_imagen.php?id_imagen= <?php echo $res["id_imagen"]; ?>" type="button" class="btn btn-default" data-dismiss="modal">Eliminar</a>-->
                            
                          
           
         
                            </div>
        
                        </a>
                    </div>
                    
                   
                 

               
                </div>

              
            <?php
        }

        ?>

     
    
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