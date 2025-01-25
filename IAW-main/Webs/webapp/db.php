<?php
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "webapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
