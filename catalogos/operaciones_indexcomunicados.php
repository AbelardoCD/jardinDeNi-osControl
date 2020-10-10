<?php
session_start();
if (!isset($_SESSION['conectado']) == 'true') {
  //  header("Location: ../index.php");
}


include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

$opcion = $_POST['opcion'];




if ($opcion == "listar_mensajes"){
    
    $consulta = "SELECT id_index_anuncio,anuncio FROM index_anuncio "; 

    $rset= @mysql_query($consulta, $cnx) or die(mysql_error());
    $cfilas = mysql_num_rows($rset);

    $arrayDatos = array();
    if ($cfilas != 0) {
        $i = 0;
        while ($fila = mysql_fetch_array($rset)) {
            $arrayDatos[$i] =
                            array(
                                'id_index_anuncio' =>  $fila['id_index_anuncio'], 
                                'anuncio' =>  $fila['anuncio'],
                        
                                
                                
                            );
                        
          $i++;
        }

    }

    echo json_encode($arrayDatos);


}
