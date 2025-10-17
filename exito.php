<?php

require_once __DIR__ . '/vendor/autoload.php';

use Fpdf;

$pdf = new FPDF('P', 'mm', array(120, 200));
$pdf->AddPage();
$pdf->SetMargins(8, 0, 0);
$pdf->Image("./img/mercadopago.png", 12, 12, 20, 20, 'PNG');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(90, 5, "Ejemplo empresa", 0, 2, 'R');
$pdf->SetFont('Arial', '', 4);
$pdf->Cell(100, 5, "Buenos Aires 1400, Neuquén Capital, Argentina", 0, 2, 'R');
$pdf->Image("./img/whatsapp.png", 76, 27, 6, 6, 'PNG');
$pdf->Cell(90, 5, "0299-4490300", 0, 2, 'R');
$pdf->Ln(12);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20, 5, "FACTURA Nro: ", 0, 0, 'L');
$pdf->Cell(20, 5, "7");
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20, 5, "Fecha y Hora: ", 0, 0, 'L');
$pdf->Cell(20, 5, date('d-m-Y H:i:s'), 0, 1, 'L');
$pdf->Cell(20, 5, "-------------------------------------------------------------------------------------------------", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(100, 5, "Datos del cliente", 0, 1, 'C');
$pdf->Cell(18, 5, mb_convert_encoding("Razón Social: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(5, 5, "Dr. Dre", 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(18, 5, mb_convert_encoding("Dirección: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, 'Compton', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(6, 5, "DNI: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, "12.345.678", 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(18, 5, mb_convert_encoding("Teléfono: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 5, "11.2233.4455", 0, 1, 'L');
$pdf->Cell(20, 5, "-------------------------------------------------------------------------------------------------", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(100, 5, "Detalle de Productos", 0, 1, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(65, 5, 'Nombre', 0, 0, 'L');
$pdf->Cell(12, 5, 'Cant', 0, 0, 'L');
$pdf->Cell(14, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(0, 5, 'Total', 0, 1, 'L');
$pdf->SetFont('Arial', '', 5.9);
$pdf->Cell(68, 5, "Silla", 0, 0, 'L');
$pdf->Cell(8, 5, '77', 0, 0, 'L');
$pdf->Cell(14, 5, "$ " . number_format(100, 2, '.', ','), 0, 0, 'L');
$importe = number_format(77 * 100, 2, '.', ',');
$pdf->Cell(15, 5, "$ " . "7777", 0, 1, 'L');
$pdf->Cell(0, 5, 
"--------------------------------------------------------------------------------------------------------------------------------",
0, 0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);

// Mostrar total
$total_formateado = number_format(7777, 2, '.', ',');
$pdf->Cell(96, 5, 'Total: $ ' . $total_formateado, 0, 1, 'R');

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(40, 5, "Compra virtual", 0, 0, 'L');
$pdf->Ln(0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(100, 5, "Gracias por su compra", 0, 1, 'C');

$pdf->Output("Factura_nro_7.pdf", "I");

?>