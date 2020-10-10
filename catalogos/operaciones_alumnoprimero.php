<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];
$id_grupo = isset($_POST['id_grupo']) ? $_POST['id_grupo'] : "0";



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    
     
   $consulta ="SELECT r.id_rel_alumno_grupo,r.id_alumno, a.nombre as ". 
   " nombre_alumno,a.apellido_paterno,a.apellido_materno,a.curp, gr.nombre AS grado, g.nombre AS grupo " .
   " FROM alumno a INNER JOIN rel_alumno_grupo r ON a.id_alumno = r.id_alumno".
   " INNER JOIN grupo g ON r.id_grupo = g.id_grupo ".
   " INNER JOIN grado gr ON g.id_grado = gr.id_grado ".
   " where g.id_grupo = '$id_grupo' ";
     

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
                                'apellido_paterno' =>  $fila['apellido_paterno'],
                                'apellido_materno' =>  $fila['apellido_materno'],                                
                                'curp' =>  $fila['curp'],                                
                                'grado' =>  $fila['grado'],
                                'grupo' =>  $fila['grupo']     
       
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
                                    'nombre' =>  $fila['nombre']
                                   
                                );
                           
             $i++;
            }
   
       }
   
        echo json_encode($arrayDatos);
   
   
   
}

//listar todos los alumnos para el combo de agregar alumno a grupo
if ($opcion == "listar_alumnos"){
    
    $id_grupo = $_POST['id_grupo'];

    $consulta = "SELECT  id_alumno, nombre, apellido_paterno,apellido_materno, fecha_nacimiento, ".
        " tipo_sangre, curp, id_tutor, direccion FROM alumno  ".
        " where id_alumno not in ( ".

        " SELECT r.id_alumno ".
        " FROM alumno a INNER JOIN rel_alumno_grupo r ON a.id_alumno = r.id_alumno ".
        " INNER JOIN grupo g ON r.id_grupo = g.id_grupo  ".
        " INNER JOIN grado gr ON g.id_grado = gr.id_grado  ".
        " where g.id_grupo = '$id_grupo'  ".
        " ) "; 

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
                                   'apellido_paterno' =>  $fila['apellido_paterno'],
                                   'apellido_materno' =>  $fila['apellido_materno'],                                   
                                   'fecha_nacimiento' =>  $fila['fecha_nacimiento'],
                                   'tipo_sangre' =>  $fila['tipo_sangre'],
                                   'curp' =>  $fila['curp'],
                                   'id_tutor' =>  $fila['id_tutor'],
                                   'direccion' =>  $fila['direccion']
                                    
                                   

                                  
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
                                   'nombre' =>  $fila['nombre']
                                  
                               );
                          
            $i++;
           }
  
      }
  
       echo json_encode($arrayDatos);


}       
        

if ($opcion == "listar_etapas"){
    
    $consulta = "SELECT  id_etapa, nombre FROM etapas"; 
  
      $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
       $cfilas = mysql_num_rows($rset);
  
       $arrayDatos = array();
       if ($cfilas != 0) {
         $i = 0;
           while ($fila = mysql_fetch_array($rset)) {
             $arrayDatos[$i] =
                             array(
                                   'id_etapa' =>  $fila['id_etapa'], 
                                   
                                   'nombre' =>  $fila['nombre']
                                  
                               );
                          
            $i++;
           }
  
      }
  
       echo json_encode($arrayDatos);


}       
  
if ($opcion == "listar_materia"){
    
    $consulta = "SELECT  id_materia, nombre, es_extraescolar FROM materia where es_extraescolar = '1'"; 
  
      $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
       $cfilas = mysql_num_rows($rset);
  
       $arrayDatos = array();
       if ($cfilas != 0) {
         $i = 0;
           while ($fila = mysql_fetch_array($rset)) {
             $arrayDatos[$i] =
                             array(
                                   'id_materia' =>  $fila['id_materia'],                                   
                                   'nombre' =>  $fila['nombre'], 
                                   'es_extraescolar' =>  $fila['es_extraescolar'],  
                                  
                               );
                          
            $i++;
           }
  
      }
  
       echo json_encode($arrayDatos);


}       
  


  



//para ejecutar un SQL DELETE de un registro




 //guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    //$id_rel_alumno_grupo = setear_comillas($_POST['id_rel_alumno_grupo']);
    $id_grupo= setear_comillas($_POST['id_grupo']);
    $id_alumno = setear_comillas($_POST['id_alumno']);
   

    
         $q = " INSERT INTO rel_alumno_grupo (id_grupo,id_alumno) "
             ." VALUES ($id_grupo, $id_alumno) ";
  
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

if ($opcion  =="guardar_calificacion"){

    //$id_rel_alumno_grupo = setear_comillas($_POST['id_rel_alumno_grupo']);
    //$id_calificacion= setear_comillas($_POST['id_calificacion']);
    $id_materia = setear_comillas($_POST['id_materia']);
    $id_rel_alumno_grupo = setear_comillas($_POST['id_rel_alumno_grupo']);
    $id_etapa = setear_comillas($_POST['id_etapa']);
    $calificacion = setear_comillas($_POST['calificacion']);
    
    
   

    
         $q = " INSERT INTO calificacion (id_materia,id_rel_alumno_grupo,id_etapa,calificacion) "
             ." VALUES ($id_materia, $id_rel_alumno_grupo,$id_etapa,$calificacion)";
  
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}

if ($opcion  =="guardar_colegiatura"){

    
   // $id_colegiatura= setear_comillas($_POST['id_colegiatura']);
    $id_alumno = setear_comillas($_POST['id_alumno']);
    $fecha_pago= setear_comillas($_POST['fecha_pago']);
    $fecha_pagado = setear_comillas($_POST['fecha_pagado']);
    $monto = setear_comillas($_POST['monto']);
    
    
   

    
         $q = " INSERT INTO colegiatura(id_alumno,fecha_pago,fecha_pagado,monto) "
             ." VALUES ( $id_alumno,$fecha_pago,$fecha_pagado,$monto)";
  
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}