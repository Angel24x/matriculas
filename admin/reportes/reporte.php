<?php

require 'fpdf/fpdf.php';
require '../db_con.php';
require 'fpdf/mysql_table.php';

$sql = "SELECT id, name, roll, class, edad, representante, sexo, city, pcontact, photo, `datetime` FROM student_info";
class PDF extends PDF_MySQL_Table
{
function Header()
{
    $this->SetFont('Arial','',10);
    $this->Cell(0,6,'Reporte de estudiantes',0,1,'C');
    $this->Ln(10);
    parent::Header();
}
}

$pdf = new PDF();
$pdf->AddPage();
// First table: output all columns
$pdf->Table($db_con, $sql);
$pdf->AddPage();
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
$pdf->Table($db_con, $sql, $prop);
$pdf->Output();
?>
