var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {
    
    $('#div_form').show();
    $('#btnEnviar').click(function (e) {
        
        e.preventDefault();
        console.log(' desde validar');

        accion = "guardar_registro"; //se inicializa para generar crear registro nuevo
            

        //validaciones
        var hasErrors = $('form[name="frmDatos"]').validator('validate').has('.has-error').length;

        if (!hasErrors) {
            var mensaje = $('#txtMensaje').val().trim();
            var primercaracter = mensaje.substring(0, 1).toLowerCase();
            var nom = primercaracter + mensaje.substring(1, 10);

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            

             //debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_contacto = id_registro_seleccionado;
            params.mensaje= $('#txtMensaje').val();
            params.correo= $('#txtCorreo').val();
           
           // debugger;
            params.opcion = "guardar_contacto"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'usuario_operaciones.php',
                type: 'POST',
                async: true,
                success: function (response) {
                    console.log(response);

                     var resultado = parseInt(response);

                    if (isNaN(resultado) || resultado == null) {
                        $('#lblMensajeInfo').html('Su mensaje no se pudo enviar');
                        $('#panelInfo').modal('show');

                    } else {
                        $('#lblMensajeInfo').html('Su mensaje fue enviado.');
                        $('#panelInfo').modal('show');

                        //refrescar la tabla html
                      //  listarRegistros();

                        //volver a la lista de registros
                       $('#div_form').hide();
                       //debugger;
                        $('#div_form').show();
                      
                    }
                    

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ": " + XMLHttpRequest.responseText);
                }

            });
           
        }
        

    });



});
    