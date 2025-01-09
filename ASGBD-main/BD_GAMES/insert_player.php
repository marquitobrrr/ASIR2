<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alias = $_POST['alias'];
    $hours = $_POST['hours'];

    $sql = "INSERT INTO PLAYERS (ALIAS, HOURS_IN_GAME) VALUES ('$alias', $hours)";
    $conn->query($sql);
    header('Location: players.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Jugador</title>
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
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            margin-top: 5px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            font-size: 1em;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-back {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: white;
            text-decoration: none;
            background-color: #6c757d;
            padding: 10px;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <header>
        <h1>Agregar Jugador</h1>
    </header>
    <div class="container">
        <form method="post">
            <label for="alias">Alias:</label>
            <input type="text" name="alias" id="alias" required>

            <label for="hours">Horas Jugadas:</label>
            <input type="number" name="hours" id="hours" required>

            <button type="submit">Agregar Jugador</button>
        </form>
        <a href="players.php" class="btn-back">Volver a la Lista de Jugadores</a>
    </div>
</body>
</html>
