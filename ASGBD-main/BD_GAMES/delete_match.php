<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM MATCHES WHERE ID_MATCH = $id";
$conn->query($sql);
header('Location: matches.php');

$conn->close();
?>
