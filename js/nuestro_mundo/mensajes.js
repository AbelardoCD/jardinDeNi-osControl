var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {

    listarRegistros();

    function listarRegistros() {
        console.log('Iniciando desde listar registros');

        var params = {};
        params.opcion = "listar_mensaje";


        $.ajax({
            data: params,
            url: 'operaciones_grupo.php',
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
                        
                        tr += "<td>" + item.mensaje +"</td>";
                        tr += "<td>" + item.correo + "</td>"; 
                        
                        //tr += "<td>" + item.nombre_grupo + "</td>";
                        
                       
                       
                        

                        tr += "<td align=center>";
                        tr += "     <label class='btn btn-success' onclick='eliminarRegistro(" + item.id_contacto + ")' >Eliminar</button>";
                        tr += "</td>";
                        

                        $('#tablaRegistros tbody').append(tr); //agregar cada registro a la tabla
                    }
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }




      //al pulsar Aceptar en el dialogo que confirma si se quiere eliminar realmente, o no
$('#btnAceptarEliminar').click(function () {
    console.log('desde aceptar eliminar');
    
    //llamada ajax para invocar el borrado
    var params = {};
    params.id_registro = id_registro_seleccionado;
    params.opcion = "eliminar_mensaje";
    $.ajax({
        data: params,
        url: 'operaciones_grupo.php',
        type: 'POST',
        async: true,
        success: function (response) {

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

});


function eliminarRegistro(id) {
    console.log('desde eliminarRegistro');
    id_registro_seleccionado = id;

    $('#lblMensajeConfirm').text('¿Está seguro que desea eliminar el registro indicado?');
    $('#panelConfirm').modal('show');

}