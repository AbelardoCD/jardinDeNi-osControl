<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT id_index_anuncio,anuncio FROM index_anuncio"; 

        

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_index_anuncio' =>  $fila['id_index_anuncio'], 
                                'anuncio' =>  $fila['anuncio']
                                
                                
                                

                               
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}










//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_index_anuncio= setear_comillas($_POST['id_index_anuncio']);
    $anuncio = setear_comillas($_POST['anuncio']);
  
  


    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO index_anuncio (anuncio) " 
            ." VALUES ($anuncio) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  index_anuncio SET  anuncio = $anuncio " 
        ." WHERE  id_index_anuncio = $id_index_anuncio ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}

//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_index_anuncio = setear_comillas($_POST['id_index_anuncio']);
  

    $query= 
    "  SELECT id_index_anuncio, anuncio FROM index_anuncio ".
    "  WHERE  id_index_anuncio = $id_index_anuncio ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}




//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM index_anuncio WHERE id_index_anuncio = $id_registro";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}