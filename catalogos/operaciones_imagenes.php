<?php

include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");
$titulo = "";


mysql_set_charset('utf8');
$cnx = conectar();

//$opcion = $_POST['opcion'];



$nom=$_REQUEST["txtnom"];
$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino="../fotos/".$foto;
copy($ruta,$destino);
$query = "insert into imagenes(nombre,ruta) values('$nom','$destino')";
$ok = @mysql_query($query, $cnx) or die(mysql_error());

if($ok){

    header("Location: imagenes.php");
}else{
    echo " no eliminado";
    
}


/*if($ok -> mysql_query($query) === TRUE){
    echo "guardado";
}else{
    echo "error";
}*/
//mysql_query("insert into imagenes (nombre,ruta) values('$nom','$destino')");
//header("Location: index.php");
/*/$destino="../fotos/";
$nom=$_REQUEST["txtnom"];
$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino="../fotos/".$foto;
copy($ruta,$destino);
mysql_query("insert into imagenes (nombre,ruta) values('$nom','$destino')");
*/
/*if ($opcion  =="guardar_registro"){

    $nombre=$_REQUEST["txtnom"];
    $foto=$_FILES["foto"]["name"];
    $ruta=$_FILES["foto"]["tmp_name"];
    $destino="../fotos/".$foto;
    copy($ruta,$destino);
    
  
    copy($foto,$destino);


    $accion = $_POST['accion'];
            
    if ($accion == "guardar"){      //<---Nuevo registro
        $q = " INSERT INTO imagenes (nombre,ruta) " 
            ." VALUES ($nombre,$destino) ";
    }
    $ok = @mysql_query($q, $cnx) or die(mysql_error());

    echo "$ok";

}*/
