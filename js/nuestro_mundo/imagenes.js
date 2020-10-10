var accion = "";
var id_registro_seleccionado = -1;
$().ready(function () {
  

    $('#btnNuevoRegistro').click(function(){

console.log("desde nueva imagen");
$('#panelCalificacion').modal('show');
//accion = "guardar"; //se inicializa para generar crear registro nuevo
    });





   /* $('#btnAceptarGuardar').click(function () {
        console.log('Desde guardar');

     

        //aplicar las validaciones
       

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_imagen = id_registro_seleccionado;
            //params. = $('#comboGrado').val();            
            params.nombre = $('#txtnom').val();
            console.log("nombre " + params.nombre);
            params.foto = $('#foto').val();
            console.log("ruta " + params.foto);
           
           // debugger;
            //params.id_tutor = $('#comboTutor').val();
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = "guardar"; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_imagenes.php',
                type: 'POST',
                async: true,
                success: function (response) {
                    console.log(response);
                           
                     var resultado = parseInt(response);

                    if (isNaN(resultado) || resultado == null) {
                        $('#lblMensajeInfo').html('No se pudo guardar.');
                        $('#panelInfo').modal('show');

                    } else {
                        $('#lblMensajeInfo').html('Guardado correctamente.');
                        $('#panelInfo').modal('show');

                        //refrescar la tabla html
                       // listarRegistros();

                        //volver a la lista de registros
                      //  $('#div_lista').show();
                        //$('#div_form').hide();

                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ": " + XMLHttpRequest.responseText);
                }

            });
       
        

    });
*/
});