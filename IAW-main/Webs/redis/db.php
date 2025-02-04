<?php
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "Agricultura";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

require 'vendor/autoload.php';
use Predis\Client;

$redis = new Client();

function setRedisCache($redis, $key, $data, $isNumeric = false) {
    $ttl = $isNumeric ? 10 : 60;
    $redis->setex($key, $ttl, json_encode($data));
}

function getFromRedisCache($redis, $key) {
    if ($redis->exists($key)) {
        return json_decode($redis->get($key), true);
    }
    return null;
}
?>
