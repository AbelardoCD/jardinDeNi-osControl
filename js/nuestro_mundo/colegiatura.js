var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {
    console.log('desde iniciando');
    $("#frmDatos").validate({
        rules: {
            txtCorreo: {
                required: true,
            },
            txtPassword:{
                required:true,
            }
            
        },
        messages: {
            txtCorreo: {
                required: "Debe ingresar un valor"
            },
            txtPassword:{
                required:"Debe ingresar un valor"
            }
        }
    });



    
    console.log('iniciando');
    //mostrar div lista de items
    $('#div_lista').show();
    //ocultar form
    $('#div_form').hide();

    listarRegistros();
   // listarTipoUsuario();

   listarAlumno();
    $('#btnNuevoRegistro').click(function () {
        console.log('Boton nuevo');
        $('#div_lista').hide();
        $('#div_form').show();
        $('#frmDatos')[0].reset(); //quitar/limpiar datos del form
        accion = "guardar"; //se inicializa para generar crear registro nuevo

    });

    function listarRegistros() {
        console.log('Iniciando desde listar registros');

        var params = {};
        params.opcion = "listar_todos";


        $.ajax({
            data: params,
            url: 'operaciones_colegiatura.php',
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


                    $('#tablaRegistros tbody').empty(); //quitar datos anteriores
                    var fecha_pagado = "";
                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        var tr = "";    
                        tr += "<tr>";
                        tr += "<td>" + item.id_colegiatura+ "</td>";
                        //tr += "<td>" + item.id_alumno+ "</td>";
                        tr += "<td>" + item.fecha_pago + "</td>";
                      //  tr += "<td>" + item.fecha_pagado + "</td>";
                        // tr += "<td>" + item.monto + "</td>";
                        
                         fecha_pagado =  item.fecha_pago ;

                        tr += "<td align=center>";
                      // tr += "     <label class='btn btn-success' onclick='editarRegistro(" + item.id_usuario + ")' >Editar</button>";
                        tr += "</td>";
                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_colegiatura+ ")' >Eliminar</button>";
                        tr += "</td>";
                        tr += "</tr>";

                        $('#tablaRegistros tbody').append(tr); //agregar cada registro a la tabla
                    }
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
               // $('#lblColegiatura').text("Su siguiente pago debe realizarse antes del: " + dia + "/" + month + "/" + year);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }

    function listarTipoUsuario() {

        var params = {};
        params.opcion = "listar_tipousuario";


        $.ajax({
            data: params,
            url: 'usuario_operaciones.php',
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
                   
                        opcion += "<option value = '" + item.id_tipo_usuario +  "'>" + item.nombre +  "</option>";
                    }

                        $('#comboTipoUsuario').append(opcion); //agregar items al combo

                        

                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


    function listarAlumno() {
        console.log("desde listar alumno");
        var params = {};
        params.opcion = "listar_alumnos";
        //params.id_grupo = $('#spnIdGrupo').text();


        $.ajax({
            data: params,
            url: 'operaciones_colegiatura.php',
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
                   
                        opcion += "<option value = '" + item.id_alumno +  "'>" + item.nombre + " " + item.apellido_paterno + " " + item.curp +"</option>";
                    }

                        $('#comboAlumno').empty().append(opcion); //agregar items al combo


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }




    $('#btnGuardar').click(function () {
        console.log('Desde guardar');

     

        //aplicar las validaciones
        var validacionesOk = $('#frmDatos').valid();
        if (validacionesOk) {

             //debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_colegiatura = id_registro_seleccionado;
            params.id_alumno = $('#comboAlumno').val();
            params.fecha_pago = $('#txtFechaPago').val();
            //params.fecha_pagado = $('#txtFechaPagado').val();
           // params.monto = $('#txtMonto').val();
            
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_colegiatura.php',
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
        url: 'operaciones_colegiatura.php',
        type: 'POST',
        async: true,
        success: function (response) {
       // debugger;
            console.log('respuesta borrado'+response);
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



});




function editarRegistro(id) {
    console.log('desde editarRegistro');
  
   id_registro_seleccionado = id; //<--Esta asignacion se hace para saber que registro está cargado actualmente


    //llamada ajax para traer los datos del registro y pintarlos en el form
    var params = {};
    params.id_usuario = id_registro_seleccionado;
    params.opcion = "obtener_registro";
   $.ajax({
       data: params,
       url: 'usuario_operaciones.php',
        type: 'POST',
        async: true,
        success: function (response) {
            //debugger;
           var datos = JSON.parse(response);

           accion = "actualizar"; //se inicializa para hacer un update
           
            // id_alumno, nombre, apellidos, fecha_nacimiento,  curp, direccion , id_tuto
            //dibujar los datos
            $('#txtCorreo').val(datos[1]);
            $('#txtpassword').val(datos[2]);
           
            $('#comboTipoUsuario').val(datos[3]);
           
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