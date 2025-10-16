<?php

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

require 'vendor/autoload.php';

MercadoPagoConfig::setAccessToken("ACÁ VA EL TOKEN DE ACCESO DE PRUEBA ");

$client = new PreferenceClient();

$preference = $client->create([
    "items" => [
        [
            "id" => "DEP-0001",
            "title" => "balon de futbol",
            "quantity" => 2,
            "unit_price" => 10,
        ],
    ],
    "statement_descriptor" => "mi prueba",
    "external_reference" => "CDP001",
])
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
        const mp = new MercadoPago('CREDENCIAL PUBLICA ',{
            locale: 'es-AR'
        });

        mp.bricks().create("wallet", "wallet_container",{
            initialization: {
                preferenceId: <?php $preference->id; ?>
            }
        })
    </script>
</body>
</html>