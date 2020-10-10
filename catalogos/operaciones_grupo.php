<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT g.id_grupo,g.id_grado,g.nombre as nombre_grupo, g.profesor_encargado,gr.id_grado, gr.nombre as nombre_grado FROM grupo as g join grado as gr on (g.id_grado = gr.id_grado)"; 
    //SELECT a.id_alumno, a.nombre as nombre_alumno, a.apellidos as apellidos_alumno,t.id_tutor, t.nombre as nombre_tutor ,t.apellidos as apellidos_tutor from alumno as a join tutor as t on (a.id_tutor = t.id_tutor)"; 

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
                                'profesor_encargado' =>  $fila['profesor_encargado']
                                
                                
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


   /*if ($opcion == "listar_grupo"){
    
    $consulta = "SELECT  id_grupo,id_grado, nombre FROM grupo"; 
  
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
                                   'nombre' =>  $fila['nombre'],
                                  
                               );
                          
            $i++;
           }
  
      }
  
       echo json_encode($arrayDatos);
  
  
  }*/






//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM grupo WHERE id_grupo = $id_registro  ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}

//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_grupo = setear_comillas($_POST['id_grupo']);
    $id_grado= setear_comillas($_POST['id_grado']);
    $nombre = setear_comillas($_POST['nombre']);
    $profesor_encargado = setear_comillas($_POST['profesor_encargado']);
   


    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO grupo (id_grado,nombre,profesor_encargado) " 
            ." VALUES ($id_grado, $nombre,$profesor_encargado) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  grupo SET  id_grado = $id_grado, nombre = $nombre, profesor_encargado = $profesor_encargado" 
        ." WHERE  id_grupo = $id_grupo ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}



//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_grupo = setear_comillas($_POST['id_grupo']);
  

    $query= 
    "  SELECT id_grupo,id_grado, nombre,profesor_encargado FROM grupo ".
    "  WHERE  id_grupo = $id_grupo ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}




// //para ejecutar un SQL DELETE de un registro
// if ($opcion  == "eliminar_registro"){
    
//     $id_registro = setear_comillas($_POST['id_registro']);

//     $query= " DELETE FROM usuario WHERE id_usuario = $id_registro ";


//     $ok = @mysql_query($query, $cnx) or die(mysql_error());

//     echo "$ok";

// }


//aqui se hara la consulta de los mendajes la cual se mostrara en mensaje.php
if ($opcion == "listar_mensaje"){
    
    $consulta = "SELECT id_contacto,mensaje,correo FROM contacto"; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_contacto' =>  $fila['id_contacto'], 
                                'mensaje' =>  $fila['mensaje'],
                                'correo' =>  $fila['correo']
                                
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}

//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_mensaje"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM contacto WHERE id_contacto = $id_registro  ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}