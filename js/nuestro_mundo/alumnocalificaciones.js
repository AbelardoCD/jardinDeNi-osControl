var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {

    $("#frmDatos").validate({
        rules: {
            txtNombre: {
                required: true,
            },
            txtApellidos: {
                required: true,
            },
            txtFechaNacimiento: {
                required: true,
            },
            txtTipoSangre: {
                required: true,
            },
            txtCurp: {
                required: true,
            },
            txtDireccion: {
                required: true,
            }
        },
        messages: {
            txtNombre: {
                required: "Debe ingresar un valor"
            },
            txtApellidos: {
                required: "Debe ingresar un valor"
            },
            txtFechaNacimiento: {
                required: "Debe ingresar la fecha de nacimiento"
            },
            txtTipoSangre: {
                required: "Debe ingresar el tipo de sangre"
            },
            txtCurp: {
                required: "Debe ingresar la CURP"
            },
            txtDireccion: {
                required: "Debe ingresar la Dirección"
            }
        }
    });


    console.log('iniciando');
    //mostrar div lista de items
    $('#div_lista').show();
    //ocultar form
    $('#div_form').hide();

    listarRegistros();

    listarTutores();

    obtenerTutor();
    listarColegiatura();
    listarComunicados();

    $('#btnNuevoRegistro').click(function () {
        console.log('Boton nuevo');
        $('#div_lista').hide();
        $('#div_form').show();
        $('#frmDatos')[0].reset(); //quitar/limpiar datos del form
        accion = "guardar"; //se inicializa para generar crear registro nuevo

    });


    function obtenerTutor() {
        console.log('desde obtenerTutor');
        var id_registro_seleccionado = $('#spnIdTutor').val();
        //debugger;

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
                console.log("datos de tutor" + response);
                //debugger;
                var datos = JSON.parse(response);

                if (response != "false") {
                    //dibujar los datos
                    $('#spnNombreTutor').text("Usuario " + datos[1] + " " + datos[2]);
                    //$('#spnIdTutor').hide();  
                } else {
                    //$('#spnIdTutor').text("");   
                    $('#spnNombreTutor').text("Usuario " + "Administrador");
                }


            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });

    }

    /**
     * Cargar los items (todos) al iniciar esta interfaz o al invocar esta función
     * 
     */

    function listarRegistros() {
        console.log('Iniciando desde listar registros');

        var params = {};
        params.opcion = "listar_todos";


        $.ajax({
            data: params,
            url: 'operaciones_alumnocalificaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {

                console.log(response);

                var listaRegistros = JSON.parse(response);

                //si no hay registros en la tabla(de base de datos) mosttrar en la tabla( del html) 
                //un mensaje que diga 'No se encontraron registros'
                if (listaRegistros == false) {

                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores
                    tr += "<tr>";
                    tr += "<td colspan = 5 >No se encontraron registros</td>";
                    tr += "</tr>";
                    $('#tablaRegistros tbody').append(tr); //agregar este registro a la tabla


                } else { //caso contrario ccuando si hay datos, 
                    //pintarlos en la tabla

                    var tipo_usuario = $('#spnIdTipoUsuario').text();

                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];

                        var tr = "";
                        tr += "<tr>";
                        tr += "<td>" + item.id_alumno + "</td>";
                        tr += "<td>" + item.nombre + "</td>";
                        tr += "<td>" + item.apellido_paterno + "</td>";
                        tr += "<td>" + item.apellido_materno + "</td>";

                        tr += "<td>" + item.fecha_nacimiento + "</td>";
                        tr += "<td>" + item.tipo_sangre + "</td>";
                        tr += "<td>" + item.curp + "</td>";
                        tr += "<td>" + item.direccion + "</td>";






                        tr += "<td align=center>";
                        tr += "     <a class='btn btn-success' href ='../pdf/generarpdf.php?id_alumno=" + item.id_alumno + "' >Boleta</a>";

                        tr += "</td>";
                        tr += "<td align=center>";
                       // tr += "     <label class='btn btn-success' onclick='listarColegiatura?id_alumno=" + item.id_alumno + ")' >Colegiatura</button>";
                        //tr += "     <a class='btn btn-success' href ='../catalogos/colegiatura.php?id_alumno=" + item.id_alumno + "' >colegiatura</a>";
                        
                        tr += "</td>";
                        //}

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

    function listarComunicados() {
        console.log('desde listar comunicados');



        var params = {};
        params.opcion = "listar_comunicados";


        $.ajax({
            data: params,
            url: 'operaciones_alumnocalificaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {

                console.log(response);



                var listaRegistros = JSON.parse(response);



                //si no hay registros en la tabla(de base de datos) mosttrar en la tabla( del html) 
                //un mensaje que diga 'No se encontraron registros'
                if (listaRegistros == false) {

                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores
                    tr += "<tr>";
                    tr += "<td colspan = 5 >No se encontraron registros</td>";
                    tr += "</tr>";
                    $('#tablaRegistros tbody').append(tr); //agregar este registro a la tabla


                } else { //caso contrario ccuando si hay datos, 
                    //pintarlos en la tabla



                    var com= "";
                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];

                        var tr = "";
                        tr += "<tr>";
                        tr += "<td>" + item.id_comunicado+ "</td>";
                        tr += "<td>" + item.comunicado + "</td>";
                        

                        com = item.comunicado;



                 


                    }

                    var comunicados = com;
                  
                     
                }
             
                $('#txtComunicado').text(comunicados);
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


    //////////////////////////////////////////
    function listarColegiatura() {
        console.log('Iniciando desde listar colegiatura');



        var params = {};
        params.opcion = "listar_colegiatura";


        $.ajax({
            data: params,
            url: 'operaciones_alumnocalificaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {

                console.log(response);



                var listaRegistros = JSON.parse(response);



                //si no hay registros en la tabla(de base de datos) mosttrar en la tabla( del html) 
                //un mensaje que diga 'No se encontraron registros'
                if (listaRegistros == false) {

                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores
                    tr += "<tr>";
                    tr += "<td colspan = 5 >No se encontraron registros</td>";
                    tr += "</tr>";
                    $('#tablaRegistros tbody').append(tr); //agregar este registro a la tabla


                } else { //caso contrario ccuando si hay datos, 
                    //pintarlos en la tabla



                    var fecha_pagado = "";
                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];

                        var tr = "";
                        tr += "<tr>";
                        tr += "<td>" + item.id_colegiatura + "</td>";
                        tr += "<td>" + item.id_alumno + "</td>";
                        tr += "<td>" + item.fecha_pago + "</td>";
                        tr += "<td>" + item.fecha_pagado + "</td>";

                        tr += "<td>" + item.monto + "</td>";





                       fecha_pagado = item.fecha_pago;


                    }
                   // var fecha_pagado = "2018/06/05";
                    var fecha = fecha_pagado;
                    var fechas = fecha.split('-');
                    var an = fechas[0];
                    var mes = fechas[1];
                    var dia = fechas[2];



                    
                     var fechaN = new Date(an, mes, dia);
                     fechaN.setMonth(fechaN.getMonth()+1);

                     var year =  fechaN.getFullYear();
                     var month =  fechaN.getMonth();
                     var day =  fechaN.getDay();

                    console.log('año = ' + year );
                    console.log('mes  = ' + month );
                    console.log('dia = ' + dia );


                   
                    
                     
                }
             
                $('#lblColegiatura').text("Su siguiente pago debe realizarse antes del: " + dia + "/" + month + "/" + year);
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }
    /////////////////////////////////////////
    $('#btnGuardar').click(function () {
        console.log('Desde guardar');



        //aplicar las validaciones
        var validacionesOk = $('#frmDatos').valid();
        if (validacionesOk) {

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_alumno = id_registro_seleccionado;
            params.nombre = $('#txtNombre').val();
            params.apellido_paterno = $('#txtApellido_paterno').val();
            params.apellido_materno = $('#txtApellido_materno').val();

            params.fecha_nacimiento = $('#txtFechaNacimiento').val();
            params.tipo_sangre = $('#txtTipoSangre').val();
            params.curp = $('#txtCurp').val();
            params.direccion = $('#txtDireccion').val();
            params.id_tutor = $('#comboTutor').val();
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_alumnocalificaciones.php',
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
        console.log('desde aceptar eliminar');

        //llamada ajax para invocar el borrado
        var params = {};
        params.id_registro = id_registro_seleccionado;
        params.opcion = "eliminar_registro";
        $.ajax({
            data: params,
            url: 'operaciones_alumnocalificaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {
                //debugger;
                console.log('respuesta borrado' + response);
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



    $('#btnCancelar').click(function () {
        $('#div_lista').show();
        $('#div_form').hide();
    });


    function listarTutores() {

        var params = {};
        params.opcion = "listar_tutores";


        $.ajax({
            data: params,
            url: 'operaciones_alumnocalificaciones.php',
            type: 'POST',
            async: true,
            success: function (response) {

                console.log(response);

                var listaRegistros = JSON.parse(response);

                if (listaRegistros == false) {



                } else { //caso contrario cuando si hay datos, 
                    //pintarlos en la tabla


                    var opcion = "";

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];

                        opcion += "<option value = '" + item.id_tutor + "'>" + item.nombre + " " + item.apellido_paterno + " " + item.apellido_materno + "</option>";
                    }

                    $('#comboTutor').append(opcion); //agregar items al combo


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }

});



function editarRegistro(id) {
    console.log('desde editarRegistro');

    id_registro_seleccionado = id; //<--Esta asignacion se hace para saber que registro está cargado actualmente


    //llamada ajax para traer los datos del registro y pintarlos en el form
    var params = {};
    params.id_alumno = id_registro_seleccionado;
    params.opcion = "obtener_registro";
    $.ajax({
        data: params,
        url: 'operaciones_alumnocalificaciones.php',
        type: 'POST',
        async: true,
        success: function (response) {
            //debugger;
            var datos = JSON.parse(response);

            accion = "actualizar"; //se inicializa para hacer un update

            // id_alumno, nombre, apellidos, fecha_nacimiento,  curp, direccion , id_tuto
            //dibujar los datos
            $('#txtNombre').val(datos[1]);
            $('#txtApellido_paterno').val(datos[2]);
            $('#txtApellido_materno').val(datos[3]);

            $('#txtFechaNacimiento').val(datos[4]);
            $('#txtTipoSangre').val(datos[5]);
            $('#txtCurp').val(datos[6]);
            $('#txtDireccion').val(datos[7]);
            $('#comboTutor').val(datos[8]);

            $('#div_lista').hide();
            $('#div_form').show();


        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ": " + XMLHttpRequest.responseText);
        }

    });

}


function eliminarRegistro(id) {
    console.log('desde eliminarRegistro');
    id_registro_seleccionado = id;

    $('#lblMensajeConfirm').text('¿Está seguro que desea eliminar el registro indicado?');
    $('#panelConfirm').modal('show');

}

