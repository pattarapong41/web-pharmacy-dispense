<?php
require('fpdf.php');
 
$pdf=new FPDF();
$pdf->AddPage();

$pdf->AddFont('angsa','','angsa.php');//ธรรมดา
$pdf->SetFont('angsa','',30);
$pdf->cell(0,5,iconv('UTF-8','cp874','รายงานของผมครับ'),0,1);
$pdf->Ln(15);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');//หนา
$pdf->SetFont('THSarabun','b',30);
$pdf->Cell(0,0,'ข้อความทดสอบ');
$pdf->Ln(15);

$pdf->AddFont('THSarabun','i','THSarabun Italic.php');//อียง
$pdf->SetFont('THSarabun','i',30);
$pdf->Cell(0,0,'ข้อความทดสอบ');
$pdf->Ln(15);

$pdf->AddFont('THSarabun','bi','THSarabun Bold Italic.php');//หนาเอียง
$pdf->SetFont('THSarabun','bi',30);
$pdf->Cell(0,0,'ข้อความทดสอบ');

$pdf->Output();
?>