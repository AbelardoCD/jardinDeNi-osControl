<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    


    
    $consulta = "SELECT id_colegiatura,id_alumno,fecha_pago FROM colegiatura"; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_colegiatura' =>  $fila['id_colegiatura'], 
                                'id_alumno' =>  $fila['id_alumno'],
                                'fecha_pago' =>  $fila['fecha_pago']
                                //'fecha_pagado' =>  $fila['fecha_pagado'],
                                //'monto' =>  $fila['monto']
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}

if ($opcion == "listar_tipousuario"){
    
    $consulta = "SELECT  id_tipo_usuario,nombre FROM tipo_usuario"; 
   
      $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
       $cfilas = mysql_num_rows($rset);
   
       $arrayDatos = array();
       if ($cfilas != 0) {
         $i = 0;
           while ($fila = mysql_fetch_array($rset)) {
             $arrayDatos[$i] =
                             array(
                                   'id_tipo_usuario' =>  $fila['id_tipo_usuario'], 
                                   'nombre' =>  $fila['nombre'],
                                   
                               );
                           
            $i++;
           }
   
      }
   
       echo json_encode($arrayDatos);
   
   
   }








//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_colegiatura= setear_comillas($_POST['id_colegiatura']);
    $id_alumno = setear_comillas($_POST['id_alumno']);
    $fecha_pago = setear_comillas($_POST['fecha_pago']);
    //$fecha_pagado = setear_comillas($_POST['fecha_pagado']);
    //$monto= setear_comillas($_POST['monto']);
    

    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO colegiatura (id_alumno, fecha_pago) " 
            ." VALUES ($id_alumno, $fecha_pago) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  colegiatura SET  id_alumno = $id_alumno, fecha_pago = $fecha_pago" 
        ." WHERE  id_colegitura = $id_colegiatura ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}



//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_usuario = setear_comillas($_POST['id_usuario']);
  

    $query= 
    "  SELECT id_usuario, correo, password,id_tipo_usuario FROM usuario ".
    "  WHERE  id_usuario = $id_usuario ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}


//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM colegiatura WHERE id_colegiatura= $id_registro ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}



/*if ($opcion == "listar_alumnos"){
    
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
  
  
  
}*/

if ($opcion == "listar_alumnos"){
    
    $consulta = "SELECT  id_alumno, nombre, apellido_paterno,apellido_materno, fecha_nacimiento, tipo_sangre, curp, id_tutor, direccion FROM alumno"; 
  
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
