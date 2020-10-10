<?php

include("globals.php");

function conectar() {
    $conexion = @mysql_connect(DBHOST, DBUSUARIO, DBPASSWORD) or die(mysql_error());
    $seleccion = @mysql_select_db(DBNOMBRE, $conexion) or die(mysql_error());
    mysql_query("SET NAMES 'utf8'");
    return $conexion;
}

function setear_comillas($in) {
    return "'" . $in . "'";
}

function toMoney($val, $symbol = '$', $r = 2) {


    $n = $val;
    $c = is_float($n) ? 1 : number_format($n, $r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n = number_format(abs($n), $r);
    $j = (($j = $i . length) > 3) ? $j % 3 : 0;

    return $symbol . $sign . ($j ? substr($i, 0, $j) + $t : '') . preg_replace('/(\d{3})(?=\d)/', "$1" + $t, substr($i, $j));
}
