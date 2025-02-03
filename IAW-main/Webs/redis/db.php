<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "Agricultura";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Conexión a Redis
require 'vendor/autoload.php';
use Predis\Client;

$redis = new Client();

// Función para guardar en caché con TTL dinámico
function setRedisCache($redis, $key, $data, $isNumeric = false) {
    $ttl = $isNumeric ? 10 : 60; // 10s para IDs, 60s para texto
    $redis->setex($key, $ttl, json_encode($data));
}

// Función para obtener desde caché
function getFromRedisCache($redis, $key) {
    if ($redis->exists($key)) {
        return json_decode($redis->get($key), true);
    }
    return null;
}
?>
