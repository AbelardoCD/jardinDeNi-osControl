<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "Aplicación contable";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];



///listar todos los registros del catalogo 
if ($opcion == "listar_todos"){
    
    $consulta = "SELECT id_proyecto, concepto_proyecto FROM proyecto"; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_proyecto' =>  $fila['id_proyecto'], 
                                'concepto_proyecto' =>  $fila['concepto_proyecto']
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}


//para ejecutar un SQL DELETE de un registro
if ($opcion  == "eliminar_registro"){
    
    $id_registro = setear_comillas($_POST['id_registro']);

    $query= " DELETE FROM proyecto WHERE id_proyecto = $id_registro ";


    $ok = @mysql_query($query, $cnx) or die(mysql_error());

    echo "$ok";

}

//guardar un registro, ya sea un INSERT (accion = guardar) o un UPDATE (accion = actualizar)
if ($opcion  =="guardar_registro"){

    $id_proyecto = setear_comillas($_POST['id_proyecto']);
    $concepto_proyecto = setear_comillas($_POST['concepto_proyecto']);
    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO proyecto (id_proyecto, concepto_proyecto) " 
            ." VALUES ($id_proyecto, $concepto_proyecto) ";
    }else{                          //<---Actualizar registro
        $q = " UPDATE  proyecto SET  concepto_proyecto = $concepto_proyecto  " 
        ." WHERE  id_proyecto = $id_proyecto ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}



//buscar y carga un solo registro para su edición
if ($opcion == "obtener_registro"){

    $id_proyecto = setear_comillas($_POST['id_proyecto']);
  

    $query= 
    "  SELECT  ".
    "       id_proyecto, concepto_proyecto  ".
    "   FROM proyecto ".
    "  WHERE  id_proyecto = $id_proyecto ";
    $rset = @mysql_query($query, $cnx) or die(mysql_error());

    $fila = mysql_fetch_row($rset);

    
    echo json_encode($fila);
}


?>