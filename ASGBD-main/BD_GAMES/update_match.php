<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM MATCHES WHERE ID_MATCH = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game_id = $_POST['game_id'];
    $player1_id = $_POST['player1_id'];
    $player2_id = $_POST['player2_id'];
    $match_name = $_POST['match_name'];
    $match_time = $_POST['match_time'];

    $sql = "UPDATE MATCHES SET ID_GAME = $game_id, ID_PLAYER1 = $player1_id, ID_PLAYER2 = $player2_id, MATCH_NAME = '$match_name', MATCH_TIME = $match_time WHERE ID_MATCH = $id";
    $conn->query($sql);
    header('Location: matches.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Partida</title>
</head>
<body>
    <h1>Modificar Partida</h1>
    <form method="post">
        <label for="game_id">Juego ID:</label>
        <input type="number" name="game_id" id="game_id" value="<?php echo $row['ID_GAME']; ?>" required><br>
        <label for="player1_id">Jugador 1 ID:</label>
        <input type="number" name="player1_id" id="player1_id" value="<?php echo $row['ID_PLAYER1']; ?>" required><br>
        <label for="player2_id">Jugador 2 ID:</label>
        <input type="number" name="player2_id" id="player2_id" value="<?php echo $row['ID_PLAYER2']; ?>" required><br>
        <label for="match_name">Nombre de la Partida:</label>
        <input type="text" name="match_name" id="match_name" value="<?php echo $row['MATCH_NAME']; ?>" required><br>
        <label for="match_time">Tiempo de la Partida (horas):</label>
        <input type="number" name="match_time" id="match_time" value="<?php echo $row['MATCH_TIME']; ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
