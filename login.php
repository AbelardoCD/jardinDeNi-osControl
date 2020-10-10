<?php

header("Content-Type: text/html;charset=utf-8");
mysql_set_charset('utf8');

$id = ($_POST['id']);
$contrasena = ($_POST['contrasena']);

include("conexion.php");
$cnx = conectar();

$consulta = "SELECT u.correo, u.password, u.id_tipo_usuario, t.id_tutor ".
			" FROM  `usuario` u ".
			" left JOIN tutor t ON ( t.id_usuario = u.id_usuario ) ".
			"    WHERE u.correo = '$id' AND u.password = '$contrasena' ";

$resultado = mysql_query($consulta, $cnx) or die(mysql_error());


$filas = mysql_num_rows($resultado);
$r = -1;
if ($filas != 0) {     
	 while ($r = mysql_fetch_array($resultado)) {
			session_start();
			$_SESSION['id_tipo_usuario'] 	= 	$r['id_tipo_usuario'];            
			$_SESSION['usuario'] 	= 	$r['correo'];            
			$_SESSION['id_tutor'] 	= 	$r['id_tutor'];            
			$_SESSION['conectado'] 		= 	true;
		
			$r= 1;
		
        }
}

echo $r;

?>
