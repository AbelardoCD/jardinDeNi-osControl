<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT a.id_alumno, a.nombre as nombre_alumno, a.apellido_paterno as apellido_paternoalumno,a.apellido_materno as apellido_maternoalumno,t.id_tutor, t.nombre as nombre_tutor ,t.apellido_paterno as apellido_paternotutor,t.apellido_materno as apellido_maternotutor from alumno as a join tutor as t on (a.id_tutor = t.id_tutor)"; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_tutor' =>  $fila['id_tutor'], 
                                'nombre_tutor' =>  $fila['nombre_tutor'],
                                'apellido_paternotutor' =>  $fila['apellido_paternotutor'],
                                'apellido_maternotutor' =>  $fila['apellido_maternotutor'],
                                
                                'id_alumno' =>  $fila['id_alumno'],                                
                                'nombre_alumno' =>  $fila['nombre_alumno'],
                                'apellido_paternoalumno' =>  $fila['apellido_paternoalumno'],
                                'apellido_maternoalumno' =>  $fila['apellido_maternoalumno']
                                
                                
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






//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM tutor WHERE id_tutor = $id_registro  ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}

//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_usuario = setear_comillas($_POST['id_usuario']);
    $correo = setear_comillas($_POST['correo']);
    $password = setear_comillas($_POST['password']);
    $id_tipo_usuario = setear_comillas($_POST['id_tipo_usuario']);


    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO usuario (correo, password, id_tipo_usuario) " 
            ." VALUES ($correo, $password, $id_tipo_usuario) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  usuario SET  correo = $correo, password = $password, id_tipo_usuario = $id_tipo_usuario " 
        ." WHERE  id_usuario = $id_usuario ";
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

    $query= " DELETE FROM usuario WHERE id_usuario = $id_registro ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}

