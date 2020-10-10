<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT id_alumno, nombre, apellidos, telefono, id_tutor FROM alumno"; 

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
                                'telefono' =>  $fila['telefono'],
                                'id_usuario' =>  $fila['id_usuario']
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}



if ($opcion == "listar_usuarios"){
    
 $consulta = "SELECT id_usuario, correo, password, id_tipo_usuario FROM alumno"; 

   $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
      $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                          array(
                                'id_alumno' =>  $fila['id_alumno'], 
                                'correo' =>  $fila['correo'],
                                'password' =>  $fila['password'],
                                'id_tipo_usuario' =>  $fila['id_tipo_usuario']
                            );
                        
          $i++;
        }

   }

    echo json_encode($arrayDatos);


}