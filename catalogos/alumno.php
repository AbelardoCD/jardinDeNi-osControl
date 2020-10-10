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

	<script type="text/javascript" src='../js/nuestro_mundo/alumno.js'></script>
	<script src='../js/validator.js'></script>

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
		<input type="hidden" id="spnIdTipoUsuario" value="<?php echo $_SESSION['id_tipo_usuario']?>"
		/>


	</table>

	<div class="container-fluid" id="div_lista">
		<div class="text-right">
			<h3>
				<label class="label label-default">Alumnos</label>
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
						<button id="btnNuevoRegistro" class="form-control btn btn-info">Nuevo</button>
					</th>

					<?php

                    }
                ?>

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

		<form id="frmDatos" role="form" name="frmDatos" data-toggle="validator">


			<!--<div class="form-group">
           <div class="col-sm-8">
                <label for="txtNombre">Nombre</label>
                <input type="text" class="form-control" id="txtNombre" title=""
                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}" data-pattern-error="Debe incluir letra ayuscula y minuscula"
                 name="txtNombre" placeholder="Nombres del alumno">
                <div class ="help-block whith-errors"></div>
            </div>-->


			<div class="form-group">

				<label class="col-sm-4 col-form-label">Nombre(s) </label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
					 data-pattern-error="Solo se aceptan letras" id="txtNombre" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>







			<div class="form-group">

				<label class="col-sm-4 col-form-label">Apellido Paterno </label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
					 data-pattern-error="Solo se aceptan letras" id="txtApellido_paterno" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>


			<div class="form-group">

				<label class="col-sm-4 col-form-label">Apellido Materno </label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
					 data-pattern-error="Solo se aceptan letras" id="txtApellido_materno" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 col-form-label">Fecha de Nacimiento</label>
				<div class="col-sm-8">


					<input type="date" class="no-simbolos-especiales form-control campo-editable" title="" min="2010-01-01" max="2015-12-31"
					 data-pattern-error="Fecha un año" id="txtFechaNacimiento" required data-required-error='Requerido' />

					<!--   pattern="^[0-3]{1,2}/?[0-2]{1,2}/?20[0-7]{2}$"  pattern="^[0-3]{1}[0-9]{1}/?[0-9]{1,2}/?20[0-5]{2}$"  pattern="^[0-9]{1,2}/?[0-9]{1,2}/?20[0-7]{2}$"<input type="date" class="form-control" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="Fecha de nacimiento" required data-required-error='Requerido' >-->
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group">

				<label class="col-sm-4 col-form-label">Tipo de Sangre </label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="[A-Z]{1,2}[+,-]{1}" data-pattern-error="Tipo de sangre"
					 id="txtTipoSangre" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>

			<div class="form-group">

				<label class="col-sm-4 col-form-label">Curp </label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9A-Z]{2}"  					  data-pattern-error="CURP" id="txtCurp" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>
			<!--////////////////pattern="[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9A-Z]{2}"  ///////////////-->
			<!--pattern="^([A-ZÑ\\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))((-)?[H,M]{1}([A-Z\\d]{6}[0-9]{1,2}))?$"-->
            <div class="form-group">

				<label class="col-sm-4 col-form-label">Dirección</label>
				<div class="col-sm-8">
					<input type="text" class="no-simbolos-especiales form-control campo-editable" title="" pattern="^[A-Za-zñÑ-áéíóúÁÉÍÓÚ0987654321#/.,\s\t-]*$"
					 data-pattern-error="Dirección" id="txtDireccion" required data-required-error='Requerido' />
					<div class="help-block with-errors"></div>

				</div>
			</div>
			<!--///////////////////////////////-->

			<div class="form-group">
				<label class="col-sm-4 col-form-label">Tutor</label>
				<div class="col-sm-8">
					<select id="comboTutor" name="comboTutor" class="form-control">
						<div class="help-block with-errors"></div>
					</select>

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
				<h4 class="modal-title text-center">
					<label id="lblTituloConfirm"></label>
				</h4>
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
				<h4 class="modal-title text-center">
					<label id="lblTituloInfo"></label>
				</h4>
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