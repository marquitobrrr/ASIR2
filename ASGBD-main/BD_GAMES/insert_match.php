<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game_id = $_POST['game_id'];
    $player1_id = $_POST['player1_id'];
    $player2_id = $_POST['player2_id'];
    $match_name = $_POST['match_name'];
    $match_time = $_POST['match_time'];

    $sql = "INSERT INTO MATCHES (ID_GAME, ID_PLAYER1, ID_PLAYER2, MATCH_NAME, MATCH_TIME) 
            VALUES ($game_id, $player1_id, $player2_id, '$match_name', $match_time)";
    $conn->query($sql);
    header('Location: matches.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Partida</title>
</head>
<body>
    <h1>Agregar Partida</h1>
    <form method="post">
        <label for="game_id">Juego ID:</label>
        <input type="number" name="game_id" id="game_id" required><br>
        <label for="player1_id">Jugador 1 ID:</label>
        <input type="number" name="player1_id" id="player1_id" required><br>
        <label for="player2_id">Jugador 2 ID:</label>
        <input type="number" name="player2_id" id="player2_id" required><br>
        <label for="match_name">Nombre de la Partida:</label>
        <input type="text" name="match_name" id="match_name" required><br>
        <label for="match_time">Tiempo de la Partida (horas):</label>
        <input type="number" name="match_time" id="match_time" required><br>
        <button type="submit">Agregar Partida</button>
    </form>
</body>
</html>
