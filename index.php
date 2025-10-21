<?php

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

require 'vendor/autoload.php';

/**
 * Esta variable ($stringLocalHostRun) tiene el propósito de ser reemplazada manualmente cada vez que se genera un nuevo link "localhost.run"
 * 
 * Creación de link:
 * - Imprimir en consola el siguiente comando:
 * 
 * ssh -o StrictHostKeyChecking=no -R 80:localhost:80 nokey@localhost.run
 * 
 * - Copiar un link parecido a: https://4a8109af46b491.lhr.life
 * - Copiar el link dentro de los corchetes de la variable $stringLocalHostRun (el link dura pocos minutos)
 * 
 * Datos adicionales:
 * - Una vez dentro de la página (ejemplo https://4a8109af46b491.lhr.life) dirigirse hasta el botón de compra, 
 * utilizar la cuenta Test (dentro de incógnito) y una vez realizada la compra presionar el botón "← VOLVER A LA TIENDA"
 * 
 * 
 * ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
 */
$stringLocalHostRun = "https://7009b85645453a.lhr.life";

MercadoPagoConfig::setAccessToken('APP_USR-3865369785003855-101116-730b8feac7c0ceffcd63df39e42227f6-2919985277');

$productos = [
    [
        "id" => "DEP-0001",
        "title" => "balon de futbol",
        "quantity" => 2,
        "unit_price" => 10,
        "img" => "view/images/futbol.webp"
    ],
    [
        "id" => "DEP-0002",
        "title" => "pelota de basquetbol",
        "quantity" => 1,
        "unit_price" => 10,
        "img" => "view/images/basquet.webp"
    ],
    [
        "id" => "DEP-0003",
        "title" => "pelota de tenis",
        "quantity" => 3,
        "unit_price" => 10,
        "img" => "view/images/tenis.webp"
    ]
];

$total = 0;
foreach ($productos as $p) {
    $total += $p['unit_price'] * $p['quantity'];
}

$request = [
    "back_urls" => [
        "success" => "$stringLocalHostRun/PWD_ClasesUtiles/exito.php",
        "failure" => "$stringLocalHostRun/PWD_ClasesUtiles/error.php",
        "pending" => "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
    ],
    "payer" => [
        "name" => "Juan",
        "surname" => "Lopez",
        "email" => "<PAYER_EMAIL>"
    ],
    "items" => $productos,
    "statement_descriptor" => "mi prueba",
    "external_reference" => "CDP001",
    "notification_url" => "$stringLocalHostRun/PWD_ClasesUtiles/exito.php"
];

$client = new PreferenceClient();
$preference = $client->create($request);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Deportiva</title>
    <link rel="stylesheet" href="view/css/index.css">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>

    <main class="productos">
        <?php foreach ($productos as $p): ?>
            <div class="producto">
                <img src="<?= $p['img'] ?>" alt="<?= $p['title'] ?>">
                <h2><?= ucfirst($p['title']) ?></h2>
                <p><strong>$<?= $p['unit_price'] ?></strong></p>
                <span>Cantidad: <?= $p['quantity'] ?></span>
            </div>
        <?php endforeach; ?>
    </main>

    <div class="pago">
        <h2>Finalizá tu compra</h2>
        <p class="total">Total a pagar: <strong>$<?= $total ?></strong></p>
        <div id="wallet_container"></div>
    </div>

    <script>
        const mp = new MercadoPago('APP_USR-1968c832-71a3-4182-baf2-4a98a9a970d7',{
            locale: 'es-AR',
        });

        mp.bricks().create("wallet", "wallet_container",{
            initialization: {
                preferenceId: '<?php echo $preference->id; ?>',
            }
        })
    </script>
</body>
</html>
