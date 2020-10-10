var accion = "";
var id_registro_seleccionado = -1;

$().ready(function () {

   

    console.log('iniciando');
    //mostrar div lista de items
   
    



    
    listarComunicados();

 

   
    /**
     * Cargar los items (todos) al iniciar esta interfaz o al invocar esta función
     * 
     */

   

    function listarComunicados() {
        console.log('desde listar comunicados');



        var params = {};
        params.opcion = "listar_mensajes";


        $.ajax({
            data: params,
            url: 'catalogos/operaciones_indexcomunicados.php',
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



                    var anu= "";
                    for (var i = 0; i < listaRegistros.length; i++) {
                        var item = listaRegistros[i];

                        var tr = "";
                        tr += "<tr>";
                        tr += "<td>" + item.id_index_anuncio+ "</td>";
                        tr += "<td>" + item.anuncio + "</td>";
                       
                        

                        anu = item.anuncio;

                    }

                    var anuncio = anu;
                    $('#txtMensaje').text(anuncio);
                     
                }
             
                
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               // console.log(textStatus + ": " + XMLHttpRequest.responseText);
            }

        });
    }


    //////////////////////////////////////////
    
    /////////////////////////////////////////
    
    



   


   
});



