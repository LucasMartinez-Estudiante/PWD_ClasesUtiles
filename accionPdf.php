<?php
  include_once __DIR__ . '/vendor/autoload.php';

  use MercadoPago\MercadoPagoConfig;
  use MercadoPago\Client\Payment\PaymentClient;
  MercadoPagoConfig::setAccessToken('APP_USR-3865369785003855-101116-730b8feac7c0ceffcd63df39e42227f6-2919985277');

  $payment_id = $_POST['payment_id'] ?? null;

  if ($payment_id) {

    $client = new PaymentClient();
    //datos del pago
    $payment = $client->get($payment_id);

    //datos del comprador
    $payer = $payment->payer ?? null;

    //datos de los items a través de preference
    $items = $payment->additional_info->items ?? [];

    $pdf = new FPDF('P', 'mm', array(120, 200));
    
    $pdf->AddPage();
    $pdf->SetMargins(8, 0, 0);
    // $pdf->Image("./img/mercadopago.png", 12, 12, 20, 20, 'PNG');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(98, 5, "Ejemplo empresa", 0, 2, 'R');
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(100, 5, "Buenos Aires 1400, Neuquen Capital, Argentina", 0, 2, 'R');
    // $pdf->Image("./img/whatsapp.png", 76, 27, 6, 6, 'PNG');
    $pdf->Cell(90, 5, "Tel.: 0299-4490300", 0, 2, 'R');
    $pdf->Ln(12);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(20, 5, "FACTURA Nro: ", 0, 0, 'L');
    $pdf->Cell(20, 5, $payment->id);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(60, 5, "Fecha y Hora (pago aprobado): ", 0, 1, 'R');
    $pdf->Cell(99, 5, $payment->date_approved, 0, 1, 'R');
    $pdf->Cell(20, 5, "-----------------------------------------------------------------------------------------------------------------------------", 0, 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(100, 5, "Datos del cliente", 0, 1, 'C');
    $pdf->Cell(18, 5, mb_convert_encoding("ID: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(25, 5, $payer->id, 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(18, 5, mb_convert_encoding("E-mail: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(5, 5, $payer->email, 0, 1, 'L');
    // $pdf->SetFont('Arial', 'B', 7);
    // $pdf->Cell(6, 5, "DNI: ", 0, 0, 'L');
    // $pdf->SetFont('Arial', '', 7);
    // $pdf->Cell(25, 5, "12.345.678", 0, 1, 'L');
    // $pdf->SetFont('Arial', 'B', 7);
    // $pdf->Cell(18, 5, mb_convert_encoding("Teléfono: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 7);
    // $pdf->Cell(25, 5, "11.2233.4455", 0, 1, 'L');
    $pdf->Cell(20, 5, "-----------------------------------------------------------------------------------------------------------------------------", 0, 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(100, 5, "Detalle de/l producto/s", 0, 1, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(65, 5, 'Nombre', 0, 0, 'L');
    $pdf->Cell(12, 5, 'Cant', 0, 0, 'L');
    $pdf->Cell(14, 5, 'Precio', 0, 0, 'L');
    $pdf->Cell(0, 5, 'Total', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 5.9);

    foreach ($items as $item){
      
      $pdf->Cell(68, 5, $item->title, 0, 0, 'L');
  
      //cantidad de producto
      $cant = $item->quantity;
  
      $pdf->Cell(8, 5, $cant, 0, 0, 'L');
      $pdf->Cell(14, 5, "$ " . number_format($item->unit_price, 2, '.', ','), 0, 0, 'L');
  
      $importe = number_format($cant * $item->unit_price, 2, '.', ',');
  
      $pdf->Cell(15, 5, $importe . " " . $payment->currency_id, 0, 1, 'L');

    }
    $pdf->Cell(0, 5, 
    "---------------------------------------------------------------------------------------------------------------------------------------------",
    0, 0, 'L');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    
    //mostrar total
    $total_formateado = number_format($importe, 2, '.', ',');
    $pdf->Cell(96, 5, 'Total: $ ' . $total_formateado, 0, 1, 'R');
    
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(40, 5, "Compra virtual", 0, 0, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(100, 5, "Gracias por su compra", 0, 1, 'C');
    
    $pdf->Output("I", "Factura_nro_" . $payment->id . ".pdf");
    
  }
  else {
      echo "No se recibió información del pago";
  }

?>