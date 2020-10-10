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
    


    

    
    function listarRegistros() {
        console.log('Iniciando desde listar registros');

        var params = {};
        params.opcion = "listar_todos";


        $.ajax({
            data: params,
            url: 'operaciones_consultatutor.php',
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
                        tr += "<td>" + item.id_tutor + "</td>";  
                        tr += "<td>" + item.nombre_tutor + "</td>";
                        tr += "<td>" + item.apellido_paternotutor + "</td>";
                        tr += "<td>" + item.apellido_maternotutor + "</td>";                        
                        tr += "<td>" + item.id_alumno + "</td>";                         
                        tr += "<td>" + item.nombre_alumno+ "</td>";
                        tr += "<td>" + item.apellido_paternoalumno+ "</td>";
                        tr += "<td>" + item.apellido_maternoalumno+ "</td>";
                        
                        // tr += "<td>" + item.id_tipo_usuario + "</td>";
                        

                        tr += "<td align=center>";
                       // tr += "     <label class='btn btn-success' onclick='editarRegistro(" + item.id_tutor + ")' >Editar</button>";
                        tr += "</td>";
                        tr += "<td align=center>";
                       //tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_tutor + ")' >Eliminar</button>";
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

    







});





