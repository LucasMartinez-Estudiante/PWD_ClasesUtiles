<?php $datos = $_GET; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pago Exitoso</title>
</head>
<body>
  <h5>Gracias por su compra</h5>

  <form action="accionPdf.php" method="POST">
    <?php foreach ($datos as $clave => $valor): ?>
      <input type="hidden" name="<?= htmlspecialchars($clave) ?>" value="<?= htmlspecialchars($valor) ?>">
    <?php endforeach; ?>
    <button type="submit">Descargar comprobante PDF</button>
  </form>
  
</body>
</html>