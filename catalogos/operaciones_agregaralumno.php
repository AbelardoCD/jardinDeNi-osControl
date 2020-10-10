<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT g.id_grupo,g.id_grado,g.nombre as nombre_grupo, gr.id_grado, gr.nombre as nombre_grado FROM grupo as g join grado as gr on (g.id_grado = gr.id_grado)"; 
     

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_grupo' =>  $fila['id_grupo'], 
                                'id_grado' =>  $fila['id_grado'],
                                'nombre_grupo' =>  $fila['nombre_grupo'],
                                'nombre_grado' =>  $fila['nombre_grado'],
                                
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}

 if ($opcion == "listar_grado"){
    
     $consulta = "SELECT  id_grado, nombre FROM grado"; 
   
       $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
        $cfilas = mysql_num_rows($rset);
   
        $arrayDatos = array();
        if ($cfilas != 0) {
          $i = 0;
            while ($fila = mysql_fetch_array($rset)) {
              $arrayDatos[$i] =
                              array(
                                    'id_grado' =>  $fila['id_grado'], 
                                    'nombre' =>  $fila['nombre'],
                                   
                                );
                           
             $i++;
            }
   
       }
   
        echo json_encode($arrayDatos);
   
   
   }








//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_grupo = setear_comillas($_POST['id_grupo']);
    $id_grado= setear_comillas($_POST['id_grado']);
    $nombre = setear_comillas($_POST['nombre']);
   


    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO grupo (id_grado,nombre) " 
            ." VALUES ($id_grado, $nombre) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  grupo SET  id_grado = $id_grado, nombre = $nombre" 
        ." WHERE  id_grupo = $id_grupo ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}






// //para ejecutar un SQL DELETE de un registro
// if ($opcion  == "eliminar_registro"){
    
//     $id_registro = setear_comillas($_POST['id_registro']);

//     $query= " DELETE FROM usuario WHERE id_usuario = $id_registro ";


//     $ok = @mysql_query($query, $cnx) or die(mysql_error());

//     echo "$ok";

// }

