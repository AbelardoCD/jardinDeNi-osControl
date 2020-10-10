var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {



    //reglas de validacion para el form que solicita los datos
    $("#frmDatos").validate({
   rules: {
        
            
            txtNombre: {
                required: true,
            },
            txtApellido_paterno: {
                required: true,
            },
            txtApellido_materno:{
                required:true,
            },
        },
        messages: {
            txtNombre: {
                required: "Debe ingresar un valor"
            },
            txtApellido_paterno: {
                required: "Debe ingresar un valor"
            },
            txtApellido_materno:{
                required:"Debe ingresar un valor"
            }
        }
    });


    /**
     * Cargar los items (todos) al iniciar esta interfaz o al invocar esta función
     * 
     */
    function listarRegistros() {

        var params = {};
        params.opcion = "listar_todos";


        $.ajax({
            data: params,
            url: 'tutor_operaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                //console.log(response);

                var listaRegistros = JSON.parse(response);

                //si no hay registros en la tabla(de base de datos) mosttrar en la tabla( del html) 
                //un mensaje que diga 'No se encontraron registros'
                if (listaRegistros == false) {

                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores
                    tr += "<tr>";
                    tr += "<td colspan = 5 >No se encontraro registros</td>";
                    tr += "</tr>";
                    $('#tablaRegistros tbody').append(tr); //agregar este registro a la tabla


                } else { //caso contrario ccuando si hay datos, 
                    //pintarlos en la tabla


                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        var tr = "";    
                        tr += "<tr>";
                        tr += "<td>" + item.id_tutor + "</td>";
                        tr += "<td>" + item.nombre + "</td>";
                        tr += "<td>" + item.apellido_paterno+ "</td>";
                        tr += "<td>" + item.apellido_materno+ "</td>";                        
                        tr += "<td>" + item.telefono + "</td>";

                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='editarRegistro(" + item.id_tutor + ")' >Editar</button>";
                        tr += "</td>";
                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_tutor + ")' >Eliminar</button>";
                        tr += "</td>";
                        tr += "</tr>";

                        $('#tablaRegistros tbody').append(tr); //agregar cada registro a la tabla
                    }
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


function listarUsuarios() {

        var params = {};
        params.opcion = "listar_usuarios";


        $.ajax({
            data: params,
            url: 'tutor_operaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                console.log(response);

                var listaRegistros = JSON.parse(response);

                if (listaRegistros == false) {

                   

                } else { //caso contrario ccuando si hay datos, 
                    //pintarlos en la tabla


                        var opcion = "";    

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        opcion += "<option value = '" + item.id_usuario + "'>"+ item.correo + "</option>";
                    }

                        $('#comboUsuario').empty().append(opcion); //agregar items al combo
                        //$('#comboAlumno').empty().append(opcion); //agregar items al combo

                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }
    


    //mostrar div lista de items
    $('#div_lista').show();
    //ocultar form
    $('#div_form').hide();


    $('#btnCancelar').click(function () {
        $('#div_lista').show();
        $('#div_form').hide();
    });

    $('#btnNuevoRegistro').click(function () {
        $('#div_lista').hide();
        $('#div_form').show();
        $('#frmDatos')[0].reset(); //quitar/limpiar datos del form
        accion = "guardar"; //se inicializa para generar crear registro nuevo

    });

    $('#btnGuardar').click(function (e) {

       
        e.preventDefault();
        console.log(' desde validar');



        //validaciones
        var hasErrors = $('form[name="frmDatos"]').validator('validate').has('.has-error').length;

        if (!hasErrors) {
            var nombre = $('#txtNombre').val().trim();
            var primercaracter = nombre.substring(0, 1).toLowerCase();
            var nom = primercaracter + nombre.substring(1, 10);



            //debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_tutor = id_registro_seleccionado;
            params.nombre = $('#txtNombre').val();
            params.apellido_paterno = $('#txtApellido_paterno').val();
            params.apellido_materno= $('#txtApellido_materno').val();            
            params.telefono = $('#txtTelefono').val();
            params.id_usuario = $('#comboUsuario').val();
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'tutor_operaciones.php',
                type: 'POST',
                async: true,
                success: function (response) {

                    var resultado = parseInt(response);

                    if (isNaN(resultado) || resultado == null) {
                        $('#lblMensajeInfo').html('No se pudo guardar.');
                        $('#panelInfo').modal('show');

                    } else {
                        $('#lblMensajeInfo').html('Guardado correctamente.');
                        $('#panelInfo').modal('show');

                        //refrescar la tabla html
                        listarRegistros();

                        //volver a la lista de registros
                        $('#div_lista').show();
                        $('#div_form').hide();

                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ": " + XMLHttpRequest.responseText);
                }

            });
        }

    });



    //al pulsar Aceptar en el dialogo que confirma si se quiere eliminar realmente, o no
    $('#btnAceptarEliminar').click(function () {

        //llamada ajax para invocar el borrado
        var params = {};
        params.id_registro = id_registro_seleccionado;
        params.opcion = "eliminar_registro";
        $.ajax({
            data: params,
            url: 'tutor_operaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {

                var resultado = parseInt(response);
                // console.log("borrados  de datos anteriores = " + resultado);

                if (isNaN(resultado) || resultado == null) {
                    $('#lblMensajeInfo').html('No se pudo eliminar el registro.');
                    $('#panelInfo').modal('show');
                } else {

                    //refrescar la tabla html
                    listarRegistros();

                    $('#lblMensajeInfo').html('Registro eliminado correctamente.');
                    $('#panelInfo').modal('show');


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });


    });


    //invocar la funcion que carga al inicio todo los datos
    listarRegistros();
    listarUsuarios();

}); //fin de ready




function eliminarRegistro(id) {
    console.log('desde eliminarRegistro');
    id_registro_seleccionado = id;

    $('#lblMensajeConfirm').text('¿Está seguro que desea eliminar el registro indicado?');
    $('#panelConfirm').modal('show');

}



function editarRegistro(id) {
    console.log('desde editarRegistro');
  
    id_registro_seleccionado = id; //<--Esta asignacion se hace para saber que registro está cargado actualmente


    //llamada ajax para traer los datos del registro y pintarlos en el form
    var params = {};
    params.id_tutor = id_registro_seleccionado;
    params.opcion = "obtener_registro";
    $.ajax({
        data: params,
        url: 'tutor_operaciones.php',
        type: 'POST',
        async: true,
        success: function (response) {
            //debugger;
            var datos = JSON.parse(response);

            accion = "actualizar"; //se inicializa para hacer un update

            //dibujar los datos
            //$('#txtIdAbono').val(datos[0]);
            $('#txtNombre').val(datos[1]);
            $('#txtApellido_paterno').val(datos[2]);
            $('#txtApellido_materno').val(datos[3]);
            $('#txtTelefono').val(datos[4]);
            $('#comboUsuario').val(datos[5]);
            

           // $('#txtIdAbono').prop('disabled', true); //deshabilitar el control de id, debido a que es id
              $('#div_lista').hide();
             $('#div_form').show();  


        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ": " + XMLHttpRequest.responseText);
        }

    });





}