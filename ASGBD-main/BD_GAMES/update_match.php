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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Partida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Modificar Partida</h1>
    </header>

    <div class="container">
        <form method="post">
            <label for="game_id">Juego ID:</label>
            <input type="number" name="game_id" id="game_id" value="<?php echo $row['ID_GAME']; ?>" required>

            <label for="player1_id">Jugador 1 ID:</label>
            <input type="number" name="player1_id" id="player1_id" value="<?php echo $row['ID_PLAYER1']; ?>" required>

            <label for="player2_id">Jugador 2 ID:</label>
            <input type="number" name="player2_id" id="player2_id" value="<?php echo $row['ID_PLAYER2']; ?>" required>

            <label for="match_name">Nombre de la Partida:</label>
            <input type="text" name="match_name" id="match_name" value="<?php echo $row['MATCH_NAME']; ?>" required>

            <label for="match_time">Tiempo de la Partida (horas):</label>
            <input type="number" name="match_time" id="match_time" value="<?php echo $row['MATCH_TIME']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
        <a href="matches.php" class="btn-back">Volver a la Lista de Partidas</a>
    </div>
</body>
</html>
