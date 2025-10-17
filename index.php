<?php

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

require 'vendor/autoload.php';

MercadoPagoConfig::setAccessToken('APP_USR-3865369785003855-101116-730b8feac7c0ceffcd63df39e42227f6-2919985277');

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
]);

$preference->back_urls = array(
    "success" => "./exito.php",
    "failure" => "./error.php",
    "pending" => "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
);
$preference->auto_return = "approved";
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