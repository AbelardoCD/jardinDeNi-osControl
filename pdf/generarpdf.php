

<?php
session_start();

include 'plantilla.php';
// include("../conexion.php");
header("Content-Type: text/html;charset=utf-8");

$id_alumno =  $_GET['id_alumno'];
 
$_SESSION['id_alumno'] = $id_alumno;


	

mysql_set_charset('utf-8');
$cnx = conectar();




//PINTAR MATERIAS
$query = " ".
" select m.nombre nombre_materia, e.nombre nombre_etapa, c.calificacion ".
"  from rel_alumno_grupo rel  ". 
" JOIN alumno a ON (a.id_alumno = rel.id_alumno) ".
" JOIN grupo g ON (g.id_grupo = rel.id_grupo) ".
" JOIN calificacion c ON (c.id_rel_alumno_grupo = rel.id_rel_alumno_grupo)  ".
" JOIN materia m ON (m.id_materia = c.id_materia) ".
" JOIN etapas e ON (e.id_etapa = c.id_etapa) ".
" WHERE a.id_alumno = '$id_alumno' ORDER BY m.id_materia, e.id_etapa ";

 $resultado= @mysql_query($query, $cnx) or die(mysql_error());


 


    $pdf = new PDF();
   
    $pdf->AddPage();
    // $pdf-->Image();
       $pdf->Image('logo1.png', 160 ,5, 28 , 28,'png');
 
    $pdf->SetFont('Arial','',10);
    $pdf->SetLineWidth(0.1);


    $i = 1;
    while ($row = mysql_fetch_array($resultado)) {

            // $fila =  $i * 20;
            // $pdf->SetXY(10, $fila );

             $pdf->Cell(70,5 ,$row['nombre_materia'],1,0,'',0);
             $pdf->Cell(30,5 ,$row['nombre_etapa'],1,0,'',0);
             $pdf->Cell(80,5 ,$row['calificacion'],1,0,'',0);
            
            $pdf->Ln(5);
        
        // $pdf->Write(5,$row['nombre_etapa']);
        // $pdf->Ln();

        $i++;

    }
        
    $pdf->Output();


    
// //PINTAR ETAPAS
// $query = " ".
// " select e.nombre nombre_etapa  from rel_alumno_grupo rel  ". 
// " JOIN alumno a ON (a.id_alumno = rel.id_alumno) ".
// " JOIN grupo g ON (g.id_grupo = rel.id_grupo) ".
// " JOIN calificacion c ON (c.id_rel_alumno_grupo = rel.id_rel_alumno_grupo)  ".
// " JOIN materia m ON (m.id_materia = c.id_materia) ".
// " JOIN etapas e ON (e.id_etapa = c.id_etapa) ".
// " WHERE a.id_alumno = 20 ORDER BY m.id_materia, e.id_etapa ";

//  $resultado= @mysql_query($query, $cnx) or die(mysql_error());

//     //$pdf = new PDF();
   
//     //$pdf->AddPage();
//     //$pdf->SetFont('Arial','B',12);

//     //$pdf->SetFont('Arial','',10);
//     $i = 5;
//     while ($row = mysql_fetch_array($resultado)) {

//             $fila =  $i * 5;
//             $pdf->SetXY(10, $fila );

//             $pdf->Cell(5,10 ,$row['nombre_etapa']);
//             $pdf->Ln();
        
//         // $pdf->Write(5,$row['nombre_etapa']);
//         // $pdf->Ln();

//         $i++;

//     }



    $pdf->Output();


    //******* 


    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }




    //*********** */
?>





