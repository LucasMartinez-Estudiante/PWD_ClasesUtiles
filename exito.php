<?php $datos = $_GET; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pago Exitoso</title>
  <link rel="stylesheet" href="view/css/index.css">
</head>
<body class="exito-body">
  <div class="exito-container">
    <h1>¡Gracias por tu compra!</h1>
    <p>Tu pago fue procesado con éxito. Podés descargar tu comprobante en formato PDF.</p>

    <form action="accionPdf.php" method="POST" class="exito-form">
      <?php foreach ($datos as $clave => $valor): ?>
        <input type="hidden" name="<?= htmlspecialchars($clave) ?>" value="<?= htmlspecialchars($valor) ?>">
      <?php endforeach; ?>
      <button type="submit" class="btn-pdf">Descargar comprobante PDF</button>
    </form>

    <a href="index.php" class="volver">← Volver a la tienda</a>
  </div>
</body>
</html>
