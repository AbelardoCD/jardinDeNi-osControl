<?php
session_start();
if (!isset($_SESSION['conectado']) == 'true') {
    header("Location: ../index.php");
}


include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $id_tutor = "";
    if (isset($_SESSION['id_tutor'])){
        $id_tutor = $_SESSION['id_tutor'];
    }


    $id_tipo_usuario = "";
    if(isset($_SESSION['id_tipo_usuario'])){
        $id_tipo_usuario = $_SESSION['id_tipo_usuario'];
    }

  

    $sqlWhereTutor = ($id_tutor == "" || $id_tipo_usuario == "1")  ? "" :  " WHERE id_tutor = '$id_tutor'  "; 

    $consulta = " SELECT id_alumno, nombre, apellido_paterno,apellido_materno,fecha_nacimiento, ".
                " tipo_sangre,curp,direccion, id_tutor ".
                " FROM alumno ". $sqlWhereTutor ;
                

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
                                'direccion' =>  $fila['direccion'],
                                
                                'id_tutor' =>  $id_tutor
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}







if ($opcion  =="guardar_registro"){

    $id_alumno = setear_comillas($_POST['id_alumno']);
    $nombre = setear_comillas($_POST['nombre']);
    $apellido_paterno = setear_comillas($_POST['apellido_paterno']);
    $apellido_materno = setear_comillas($_POST['apellido_materno']);
    
    $fecha_nacimiento = setear_comillas($_POST['fecha_nacimiento']);
   
    $tipo_sangre = setear_comillas($_POST['tipo_sangre']);
    $curp = setear_comillas($_POST['curp']);
    $direccion = setear_comillas($_POST['direccion']);
    $id_tutor = setear_comillas($_POST['id_tutor']);

    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
    $apellido_paterno = setear_comillas($_POST['apellido_paterno']);
        $q = " INSERT INTO alumno (nombre, apellido_paterno,apellido_materno, fecha_nacimiento, tipo_sangre, curp, direccion, id_tutor) " 
            ." VALUES ($nombre, $apellido_paterno,$apellido_materno, $fecha_nacimiento, $tipo_sangre, $curp, $direccion, $id_tutor) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  alumno SET  nombre = $nombre, apellido_paterno = $apellido_paterno,apellido_materno = $apellido_materno, fecha_nacimiento = $fecha_nacimiento, tipo_sangre = $tipo_sangre, curp = $curp, 
        direccion = $direccion, id_tutor = $id_tutor " 
        ." WHERE  id_alumno = $id_alumno ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}

//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_alumno = setear_comillas($_POST['id_alumno']);
  

    $query= 
    "  SELECT id_alumno, nombre, apellido_paterno, apellido_materno , fecha_nacimiento,tipo_sangre,  curp, direccion , id_tutor FROM alumno ".
    "  WHERE  id_alumno = $id_alumno ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}

//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM alumno WHERE id_alumno = $id_registro  ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}
 
 if ($opcion == "listar_tutores"){
    
    $consulta = "SELECT id_tutor,nombre,apellido_paterno,apellido_materno,telefono,id_usuario FROM tutor "; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_tutor' =>  $fila['id_tutor'], 
                                'nombre' =>  $fila['nombre'],
                                'apellido_paterno' =>  $fila['apellido_paterno'],
                                'apellido_materno' =>  $fila['apellido_materno'],                                
                                'telefono' =>  $fila['telefono'],
                                'id_usuario' =>  $fila['id_usuario']
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}
