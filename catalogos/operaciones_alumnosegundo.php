<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    
     
   $consulta ="SELECT r.id_rel_alumno_grupo,r.id_alumno, a.nombre as nombre_alumno,a.apellidos,a.curp, gr.nombre AS grado, g.nombre AS grupo FROM alumno a INNER JOIN rel_alumno_grupo r ON a.id_alumno = r.id_alumno INNER JOIN grupo g ON r.id_grupo = g.id_grupo INNER JOIN grado gr ON g.id_grado = gr.id_grado where g.id_grado = 2";
     

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_rel_alumno_grupo' =>  $fila['id_rel_alumno_grupo'],                                
                                'id_alumno' =>  $fila['id_alumno'], 
                                'nombre_alumno' =>  $fila['nombre_alumno'],
                                'apellidos' =>  $fila['apellidos'],
                                'curp' =>  $fila['curp'],                                
                                'grado' =>  $fila['grado'],
                                'grupo' =>  $fila['grupo'],     
                                //'id_grado' =>  $fila['id_grado'],     
                                
                                //'nombre_grupo' =>  $fila['nombre_grupo'],
                                
                                
                                
                                
                            
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}



//
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

//listar alumnos
if ($opcion == "listar_alumnos"){
    
    $consulta = "SELECT  id_alumno, nombre, apellidos, fecha_nacimiento, tipo_sangre, curp, id_tutor, direccion FROM alumno"; 
  
      $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
       $cfilas = mysql_num_rows($rset);
  
       $arrayDatos = array();
       if ($cfilas != 0) {
         $i = 0;
           while ($fila = mysql_fetch_array($rset)) {
             $arrayDatos[$i] =
                             array(
                                   'id_alumno' =>  $fila['id_alumno'], 
                                   'nombre' =>  $fila['nombre'],
                                   'apellidos' =>  $fila['apellidos'],
                                   'fecha_nacimiento' =>  $fila['fecha_nacimiento'],
                                   'tipo_sangre' =>  $fila['tipo_sangre'],
                                   'curp' =>  $fila['curp'],
                                   'id_tutor' =>  $fila['id_tutor'],
                                   'direccion' =>  $fila['direccion'],
                                    
                                   

                                  
                               );
                          
            $i++;
           }
  
      }
  
       echo json_encode($arrayDatos);
  
  
  
}


//




   if ($opcion == "listar_grupo"){
    
    $consulta = "SELECT  id_grupo, id_grado, nombre FROM grupo"; 
  
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


}       
        
  
  


  



//para ejecutar un SQL DELETE de un registro




 //guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_rel_alumno_grupo = setear_comillas($_POST['id_rel_alumno_grupo']);
    $id_grupo= setear_comillas($_POST['id_grupo']);
    $id_alumno = setear_comillas($_POST['id_alumno']);
   

    
    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
         $q = " INSERT INTO rel_alumno_grupo (id_grupo,id_alumno) "
             ." VALUES ($id_grupo, $id_alumno) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  rel_alumno_grupo SET  id_grupo = $id_grupo, id_alumno = $id_alumno WHERE  id_rel_alumno_grupo = $id_rel_alumno_grupo ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}




//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_rel_alumno_grupo = setear_comillas($_POST['id_rel_alumno_grupo']);
  

    $query= 
    "  SELECT id_rel_alumno_grupo, id_grupo,id_alumno FROM rel_alumno_grupo ".
    "  WHERE  id_rel_alumno_grupo = $id_rel_alumno_grupo ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}

//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM rel_alumno_grupo WHERE id_rel_alumno_grupo = $id_registro  ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}
// //para ejecutar un SQL DELETE de un registro
// if ($opcion  == "eliminar_registro"){
    
//     $id_registro = setear_comillas($_POST['id_registro']);

//     $query= " DELETE FROM usuario WHERE id_usuario = $id_registro ";


//     $ok = @mysql_query($query, $cnx) or die(mysql_error());

//     echo "$ok";

// }

