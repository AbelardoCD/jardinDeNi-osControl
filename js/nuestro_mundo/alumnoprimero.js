var accion = "";
var id_registro_seleccionado = -1;
var id_rel_seleccionado=-1;
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

    obtenerGrupo($('#spnIdGrupo').text());
   
    listarRegistros($('#spnIdGrupo').text());
    listarAlumno();
    listarEtapa();
    listarMateria();
    // listarGrado();
    //listarGrupo();
    

    $('#btnNuevoRegistro').click(function () {
        console.log('Boton nuevo');
        $('#div_lista').hide();
        $('#div_form').show();
        $('#frmDatos')[0].reset(); //quitar/limpiar datos del form
        accion = "guardar"; //se inicializa para generar crear registro nuevo

    });


    

    function obtenerGrupo(id) {
        console.log('desde obtenerGrupo id  = ' + id);
       
        id_registro_seleccionado = id; //<--Esta asignacion se hace para saber que registro está cargado actualmente
    
    
        //llamada ajax para traer los datos del registro y pintarlos en el form
        var params = {};
        params.id_grupo = id_registro_seleccionado;
        params.opcion = "obtener_registro";
        $.ajax({
            data: params,
            url: 'operaciones_grupo.php',
            type: 'POST',
            async: true,
            success: function (response) {
                
                var datos = JSON.parse(response);
                console.log('datos = ' + datos);
    
             
                //dibujar los datos
                $('#lblNombreGrupo').text("Grupo: " + datos[1] + datos[2]);
        
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
    function listarRegistros(id_grupo) {
        console.log('Iniciando desde listar registros');

        var params = {};
        params.opcion = "listar_todos";
        params.id_grupo = id_grupo;


        $.ajax({
            data: params,
            url: 'operaciones_alumnoprimero.php',
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
                       // tr += "<td>" + item.id_rel_alumno_grupo + "</td>";    
                        tr += "<td>" + item.id_alumno + "</td>"; 
                        tr += "<td>" + item.nombre_alumno + "</td>";
                        tr += "<td>" + item.apellido_paterno + "</td>";
                        tr += "<td>" + item.apellido_materno + "</td>";                        
                        tr += "<td>" + item.curp + "</td>";                                                
                        tr += "<td>" + item.grado+ "</td>";
                        tr += "<td>" + item.grupo+ "</td>";
            
            
                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_rel_alumno_grupo + ")' >Eliminar</button>";
                        tr += "</td>";
                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='panelCalificacion(" + item.id_rel_alumno_grupo + ")' >Calificación</button>";                                             
                        tr += "</td>";
                        tr += "<td align=center>";
                        //tr += "     <label class='btn btn-success' onclick='panelColegiatura(" + item.id_alumno + ")' >Colegiatura</button>";
                        
                      // tr += "     <label class='btn btn-success' onclick='panelColegiatura(" + item.colegiatura+ ")' >Colegiatura</button>";
                      tr += "     <a class='btn btn-success' href ='../catalogos/colegiatura.php?idalumno="+  item.id_alumno + "' >Colegiatura</a>";
                                                                                           
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

    //Agrega o asocia un alumno a un grupo
    $('#btnGuardar').click(function () {
        console.log('Desde guardar');

     

        //aplicar las validaciones
        var validacionesOk = $('#frmDatos').valid();
        if (validacionesOk) {

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};
            params.id_grupo = $('#spnIdGrupo').text();
            params.id_alumno = $('#comboAlumno').val();
                        
           
           
           // debugger;
            //params.id_tutor = $('#comboTutor').val();
            params.opcion = "guardar_registro"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_alumnoprimero.php',
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
                        listarRegistros($('#spnIdGrupo').text());
                        listarAlumno();

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
        url: 'operaciones_alumnoprimero.php',
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
                listarRegistros($('#spnIdGrupo').text());

                $('#lblMensajeInfo').html('Registro eliminado correctamente.');
                $('#panelInfo').modal('show');


            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ": " + XMLHttpRequest.responseText);
        }

    });


});


$('#btnAceptarGuardar').click(function () {
    console.log('desde aceptar Guardar');
    for(var i = 1;i<7;i++){
    //llamada ajax para invocar el borrado
    var params = {};


    params.calificacion= $('#txt'+i).val();
    params.id_materia = i;
    params.id_rel_alumno_grupo = id_rel_seleccionado;
    params.id_etapa =  $('#comboEtapa').val();
    
    
    

    //params.id_registro = id_registro_seleccionado;
    params.opcion = "guardar_calificacion";
    $.ajax({
        data: params,
        url: 'operaciones_alumnoprimero.php',
        type: 'POST',
        async: false,
        success: function (response) {
                //debugger;
            console.log('respuesta borrado'+response);
            var resultado = parseInt(response);
            // console.log("borrados  de datos anteriores = " + resultado);

            if (isNaN(resultado) || resultado == null) {
                $('#lblMensajeInfo').html('No se pudo guardar el registro.');
                $('#panelInfo').modal('show');
            } else {

                //refrescar la tabla html
                listarRegistros($('#spnIdGrupo').text());

                $('#lblMensajeInfo').html('Registro guardado correctamente.');
                $('#panelInfo').modal('show');


            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ": " + XMLHttpRequest.responseText);
        }

    });

    }//final del for
    
    var params = {};
    

    params.calificacion= $('#txtCalificacionExtracurricular').val();
    params.id_materia = $('#comboExtracurricular').val();;
    params.id_rel_alumno_grupo = id_rel_seleccionado;
    params.id_etapa =  $('#comboEtapa').val();
    
    
    

    //params.id_registro = id_registro_seleccionado;
    params.opcion = "guardar_calificacion";
    $.ajax({
        data: params,
        url: 'operaciones_alumnoprimero.php',
        type: 'POST',
        async: false,
        success: function (response) {
                //debugger;
            console.log('respuesta borrado'+response);
            var resultado = parseInt(response);
            // console.log("borrados  de datos anteriores = " + resultado);

            if (isNaN(resultado) || resultado == null) {
                $('#lblMensajeInfo').html('No se pudo guardar el registro.');
                $('#panelInfo').modal('show');
            } else {

                //refrescar la tabla html
                listarRegistros($('#spnIdGrupo').text());

                $('#lblMensajeInfo').html('Registro guardado correctamente.');
                $('#panelInfo').modal('show');


            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ": " + XMLHttpRequest.responseText);
        }

    });

    
    
    
});

  ////////////////////////////////////////////////////////////////77
 $('#btnAceptarGuardarColegiatura').click(function () {
        console.log('Desde guardar');

     

        //aplicar las validaciones
       // var validacionesOk = $('#frmDatos').valid();
       // if (validacionesOk) {

            //  debugger;
            //si pasa las validaciones, entonces invocar el guardado
            var params = {};

            params.id_alumno = id_rel_seleccionado;
          
           params.id_colegiatura = $('#txtid_colegiatura').text();
            params.fecha_pago = $('#txtFechaPago').val();
            params.fecha_pagado= $('#txtFechaPagado').val();
            
            params.monto = $('#txtMonto').val();
                         
        
           
           
           // debugger;
            //params.id_tutor = $('#comboTutor').val();
            params.opcion = "guardar_colegiatura"; //opcion para saber que operacion ejecutar   
            params.accion = accion; //para saber si es insert o update
            $.ajax({
                data: params,
                url: 'operaciones_alumnoprimero.php',
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
                        //listarRegistros($('#spnIdGrado').text());
                        //listarAlumno();

                        //volver a la lista de registros
                        $('#div_lista').show();
                        $('#div_form').hide();

                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ": " + XMLHttpRequest.responseText);
                }

            });
       
        //}

    });
  

  ////////////////////////////////////////////////////////////////7



    $('#btnCancelar').click(function () {
        $('#div_lista').show();
        $('#div_form').hide();
    });


    function listarGrado() {

        var params = {};
        params.opcion = "listar_grado";


        $.ajax({
            data: params,
            url: 'operaciones_alumnoprimero.php',
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
            url: 'operaciones_alumnoprimero.php',
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

    function listarEtapa() {

        var params = {};
        params.opcion = "listar_etapas";


        $.ajax({
            data: params,
            url: 'operaciones_alumnoprimero.php',
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
                   
                        opcion += "<option value = '" + item.id_etapa +  "'>"  +" "+ item.nombre + "</option>";
                    }

                        $('#comboEtapa').append(opcion); //agregar items al combo


                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }



    function listarMateria() {

        var params = {};
        params.opcion = "listar_materia";


        $.ajax({
            data: params,
            url: 'operaciones_alumnoprimero.php',
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
                   
                        opcion += "<option value = '" + item.id_materia +  "'>"  +" "+ item.nombre + "</option>";
                    }

                        $('#comboExtracurricular').append(opcion); //agregar items al combo


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
        params.id_grupo = $('#spnIdGrupo').text();


        $.ajax({
            data: params,
            url: 'operaciones_alumnoprimero.php',
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
                   
                        opcion += "<option value = '" + item.id_alumno +  "'>" + item.nombre + " " + item.apellido_paterno +" " + item.apellido_materno +" " + item.curp +"</option>";
                    }

                        $('#comboAlumno').empty().append(opcion); //agregar items al combo


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
       url: 'operaciones_alumnoprimero.php',
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
           
            
            //$('#comboGrado').val(datos[2]);
            
            
            
           // $('#ComboAlumno').val(datos[2]);
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

function panelCalificacion(id_rel_alumno_grupo) {
    console.log('desde cal' + id_rel_alumno_grupo);
    
 id_rel_seleccionado = id_rel_alumno_grupo;
   // $('#lblMensajeConfirm').text('Calificacion');
    $('#panelCalificacion').modal('show');

}

///////////////
function panelColegiatura(id_alumno) {
    console.log('desde cal' + id_alumno);
    
 id_rel_seleccionado = id_alumno;
   // $('#lblMensajeConfirm').text('Calificacion');
    $('#panelColegiatura').modal('show');

}