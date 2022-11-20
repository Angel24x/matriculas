<?php


require 'fpdf/fpdf.php';
require '../reportes/reporte';
$sql = "SELECT id, name, roll, class, edad, representante, sexo, city, pcontact, photo, datetime FROM student_info WHERE activo=1";
$resultado = $mysqli->query($sql);
// Creación del objeto de la clase heredada
$pdf = new FPDF("P", "mm", "LETTER");
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);

$pdf->Cell(50, 5, "name", 1, 1, "C");
$pdf->Cell(50, 5, "roll", 1, 1, "C");
$pdf->Cell(50, 5, "class", 1, 1, "C");
$pdf->Cell(50, 5, "edad", 1, 1, "C");
$pdf->Cell(50, 5, "representante", 1, 1, "C");
$pdf->Cell(50, 5, "sexo", 1, 1, "C");
$pdf->Cell(50, 5, "city", 1, 1, "C");
$pdf->Cell(50, 5, "pcontact", 1, 1, "C");
$pdf->Cell(50, 5, "photo", 1, 1, "C");
$pdf->Cell(50, 5, "datetime", 1, 1, "C");

while ($row = $resultado->fetch_assoc()) {

    $pdf->Cell(50, 5, $row["name"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["roll"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["class"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["edad"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["representante"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["sexo"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["city"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["pcontact"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["photo"], 1, 1, "C");
    $pdf->Cell(50, 5, $row["datetime"], 1, 1, "C");
}

$pdf->Output();
