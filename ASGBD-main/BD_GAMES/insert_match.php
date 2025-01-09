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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Partida</title>
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
            max-width: 500px;
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
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="number"], input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
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
            margin: 10px 0;
            padding: 10px;
            text-align: center;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <header>
        <h1>Agregar Partida</h1>
    </header>

    <div class="container">
        <a href="matches.php" class="btn-back">Volver a la Lista de Partidas</a>
        <form method="post">
            <label for="game_id">Juego ID:</label>
            <input type="number" name="game_id" id="game_id" required>

            <label for="player1_id">Jugador 1 ID:</label>
            <input type="number" name="player1_id" id="player1_id" required>

            <label for="player2_id">Jugador 2 ID:</label>
            <input type="number" name="player2_id" id="player2_id" required>

            <label for="match_name">Nombre de la Partida:</label>
            <input type="text" name="match_name" id="match_name" required>

            <label for="match_time">Tiempo de la Partida (horas):</label>
            <input type="number" name="match_time" id="match_time" required>

            <button type="submit">Agregar Partida</button>
        </form>
    </div>
</body>
</html>
