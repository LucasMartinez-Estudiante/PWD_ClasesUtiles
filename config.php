<?php
// Manejo de .env (tokens)
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar variables del entorno
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$accessToken = $_ENV['MERCADOPAGO_ACCESS_TOKEN'] ?? '';
$publicKey = $_ENV['MERCADOPAGO_PUBLIC_KEY'] ?? '';
?>