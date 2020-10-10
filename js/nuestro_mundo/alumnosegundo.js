var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {

    $("#frmDatos").validate({
        rules: {
            txtGrupo: {
                required: true,
            }
    
        },
        messages: {
            txtGrupo: {
                required: "Debe ingresar un Grupo"
            }
        }
    });


    console.log('iniciando');
    //mostrar div lista de items
    $('#div_lista').show();
    //ocultar form
    $('#div_form').hide();

    listarRegistros();
    listarAlumno();
    listarGrado();
    listarGrupo();
    

    $('#btnNuevoRegistro').click(function () {
        console.log('Boton nuevo');
        $('#div_lista').hide();
        $('#div_form').show();
        $('#frmDatos')[0].reset(); //quitar/limpiar datos del form
        accion = "guardar"; //se inicializa para generar crear registro nuevo

    });


    

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
            url: 'operaciones_alumnosegundo.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                console.log(response);
                //debugger;
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

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        var tr = "";    
                        tr += "<tr>";
                        tr += "<td>" + item.id_alumno + "</td>"; 
                        tr += "<td>" + item.nombre_alumno + "</td>";
                        tr += "<td>" + item.apellidos + "</td>";
                        tr += "<td>" + item.curp + "</td>";                                                
                        tr += "<td>" + item.grado+ "</td>";
                        tr += "<td>" + item.grupo+ "</td>";
                       // tr += "<td>" + item.nombre_grupo + "</td>";
                        
                        
                        
                        
                        
                        
                       
                       
                        

                        tr += "<td align=center>";
                        tr += "<label class='btn btn-success' onclick='editarRegistro(" + item.id_rel_alumno_grupo + ")'>Editar</button>";
                        tr += "</td>";
                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_rel_alumno_grupo + ")' >Eliminar</button>";
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

    $('#btnGuardar').click(function () {
        console.log('Desde guardar');

     

        //aplicar las validaciones
        var validacionesOk = $('#frmDatos').valid();
        if (validacionesOk) {

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_rel_alumno_grupo = id_registro_seleccionado;

            params.id_grupo = $('#comboGrupo').val();  
            params.id_grado = $('#comboGrado').val();
                
            params.id_alumno = $('#comboAlumno').val();
                        
           
           
           // debugger;
            //params.id_tutor = $('#comboTutor').val();
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_alumnosegundo.php',
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
        url: 'operaciones_alumnosegundo.php',
        type: 'POST',
        async: true,
        success: function (response) {
                //debugger;
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


    function listarGrado() {

        var params = {};
        params.opcion = "listar_grado";


        $.ajax({
            data: params,
            url: 'operaciones_alumnosegundo.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                //console.log(response);

                var listaRegistros = JSON.parse(response);

                if (listaRegistros == false) {

                   

                } else { //caso contrario cuando si hay datos, 
                    //pintarlos en la tabla


                        var opcion = "";    

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        opcion += "<option value = '" + item.id_grado +  "'>" + item.nombre + "</option>";
                    }

                        $('#comboGrado').append(opcion); //agregar items al combo


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


    function listarGrupo() {

        var params = {};
        params.opcion = "listar_grupo";


        $.ajax({
            data: params,
            url: 'operaciones_alumnosegundo.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                //console.log(response);

                var listaRegistros = JSON.parse(response);

                if (listaRegistros == false) {

                   

                } else { //caso contrario cuando si hay datos, 
                    //pintarlos en la tabla


                        var opcion = "";    

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        opcion += "<option value = '" + item.id_grupo +  "'>" +item.id_grado +" "+ item.nombre + "</option>";
                    }

                        $('#comboGrupo').append(opcion); //agregar items al combo


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


    function listarAlumno() {

        var params = {};
        params.opcion = "listar_alumnos";


        $.ajax({
            data: params,
            url: 'operaciones_alumnosegundo.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                //console.log(response);

                var listaRegistros = JSON.parse(response);

                if (listaRegistros == false) {

                   

                } else { //caso contrario cuando si hay datos, 
                    //pintarlos en la tabla


                        var opcion = "";    

                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];
                   
                        opcion += "<option value = '" + item.id_alumno +  "'>" + item.nombre + " " + item.apellidos + " " + item.curp +"</option>";
                    }

                        $('#comboAlumno').append(opcion); //agregar items al combo


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
    params.id_rel_alumno_grupo = id_registro_seleccionado;
    params.opcion = "obtener_registro";
   $.ajax({
       data: params,
       url: 'operaciones_alumnosegundo.php',
        type: 'POST',
        async: true,
        success: function (response) {
            //debugger;
           var datos = JSON.parse(response);

           accion = "actualizar"; //se inicializa para hacer un update
           
            // id_alumno, nombre, apellidos, fecha_nacimiento,  curp, direccion , id_tuto
            //dibujar los datos
          
           $('#comboAlumno').val(datos[2]);
           $('#comboGrupo').val(datos[1]);
           
            
            
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

