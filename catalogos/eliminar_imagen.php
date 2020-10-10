<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();


$id_imagen = $_REQUEST["id_imagen"];

$query = "DELETE FROM imagenes WHERE id_imagen = $id_imagen";
$ok = @mysql_query($query, $cnx) or die(mysql_error());

if($ok){

    header("Location: imagenes.php");
}else{
    echo " no eliminado";
    
}