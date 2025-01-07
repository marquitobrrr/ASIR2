<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM PLAYERS WHERE ID_PLAYERS = $id";
$conn->query($sql);
header('Location: players.php');

$conn->close();
?>
