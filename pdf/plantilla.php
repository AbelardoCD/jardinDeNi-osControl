



<?php
//session_start();

require 'fpdf/fpdf.php';

include("../conexion.php");


class PDF extends FPDF{

   
    function Header(){
        
       
       
        $this->SetFont('Arial','B',15);
        //$this->SetFont('Arial','B',15);
        
        $this->Cell(170,10,utf8_decode('REPORTE DE EVALUACIÓN'));
        
        
      
        header("Content-Type: text/html;charset=utf-8");
        $id_alumno =   $_SESSION['id_alumno'];
        

        mysql_set_charset('utf-8');
        $cnx = conectar();

        //PINTAR MATERIAS
        $query = " ".
        " select concat(a.nombre,' ', a.apellido_paterno,' ', a.apellido_materno) as nombre_alumno ".
        "  ,m.nombre nombre_materia, e.nombre nombre_etapa, c.calificacion ".
        "  from rel_alumno_grupo rel  ". 
        " JOIN alumno a ON (a.id_alumno = rel.id_alumno) ".
        " JOIN grupo g ON (g.id_grupo = rel.id_grupo) ".
        " JOIN calificacion c ON (c.id_rel_alumno_grupo = rel.id_rel_alumno_grupo)  ".
        " JOIN materia m ON (m.id_materia = c.id_materia) ".
        " JOIN etapas e ON (e.id_etapa = c.id_etapa) ".
        " WHERE a.id_alumno = '$id_alumno' ORDER BY m.id_materia ";

        $resultado= @mysql_query($query, $cnx) or die(mysql_error());

         
        


 
        $this->Ln();
        
        

        $this->SetFont('Arial','B',12);
        $this->Cell(50, 5 ,'Nombre del alumno: ');        
    
    $i = 1;
    while ($row = mysql_fetch_array($resultado)) {
        $this->Cell(50, 5 ,utf8_decode( $row['nombre_alumno']));        
        $i++;
        if ($i==2) break;
        
    }


         

        //////////
        //$id_grupo = $_SESSION['id_grupo'];
       // $query = "SELECT g.profesor_encargado AS profesor, f.id_alumno AS 
        //alumno FROM grupo AS g  JOIN rel_alumno_grupo AS f ON g.id_grupo = f.id_grupo 
        //";
        $query = " ".
        " select  g.id_grupo,g.profesor_encargado AS profesor,rel.id_alumno ".
        "from rel_alumno_grupo rel ".
        "JOIN grupo g ON (rel.id_grupo = g.id_grupo)".
        "where rel.id_alumno = '$id_alumno'";
        $res = @mysql_query($query, $cnx) or die(mysql_error());
        $this->Ln();
        $this->Cell(50,5,'Profesor:');   
        $i = 1;
    while ($row = mysql_fetch_array($res)) {
        $this->Cell(50, 5 ,utf8_decode($row['profesor']));        
        $i++;
        if ($i==2) break;
        
    }
       // $res = @mysql_query($query, $cnx) or die(mysql_error());
        //$row = mysql_fetch_array($res);
        //$this->cell(100,10,$row['profesor']);
         ///////////


        $this->Ln();
        $this->Ln();
        $this->Ln();
        
        $this->SetFont('Arial','B',10);

        $this->Cell(70,10,'MATERIA',1);
        $this->Cell(30,10,'ETAPA',1);
        $this->Cell(80,10,'CALIFICACION',1);

        $this->Ln();




    }

    
       

    /*function Footer(){

        $this->sety(-15);
        $this->setFont('Arial','I',8);
        $this->cell(0,10,'Pagina'$this->PageNo().'/{nb}',0,0,'C');


    }*/
}
?>
