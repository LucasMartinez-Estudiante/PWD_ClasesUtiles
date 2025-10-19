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
$stringLocalHostRun = "https://1901e88c261d7a.lhr.life";

MercadoPagoConfig::setAccessToken('APP_USR-3865369785003855-101116-730b8feac7c0ceffcd63df39e42227f6-2919985277');

$request = [
    "back_urls" => [
        "success" => "$stringLocalHostRun/PWD_ClasesUtiles/exito.php",
        "failure" => "./error.php",
        "pending" => "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
    ],
    "payer" => [
        "name" => "Juan",
        "surname" => "Lopez",
        "email" => "<PAYER_EMAIL>"
    ],
    "items" => [
        [
            "id" => "DEP-0001",
            "title" => "balon de futbol",
            "quantity" => 2,
            "unit_price" => 10,
        ],
        [
            "id" => "DEP-0002",
            "title" => "pelota de basquetbol",
            "quantity" => 1,
            "unit_price" => 10,
        ],
        [
            "id" => "DEP-0003",
            "title" => "pelota de tenis",
            "quantity" => 3,
            "unit_price" => 10,
            ]
        ],
        "statement_descriptor" => "mi prueba",
        "external_reference" => "CDP001",
        
        "notification_url" => "$stringLocalHostRun/PWD_ClasesUtiles/exito.php"
    ];
    
$client = new PreferenceClient();
$preference = $client->create($request);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi prueba de MP</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <div id="wallet_container"></div>
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