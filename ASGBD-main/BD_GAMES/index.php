<?php
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "BD_GAMES";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$gamesCount = $conn->query("SELECT COUNT(*) FROM GAMES")->fetch_row()[0];
$playersCount = $conn->query("SELECT COUNT(*) FROM PLAYERS")->fetch_row()[0];
$matchesCount = $conn->query("SELECT COUNT(*) FROM MATCHES")->fetch_row()[0];

$playersIn2Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) = 2")->fetch_row()[0];
$playersIn3Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) = 3")->fetch_row()[0];
$playersInMoreThan3Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) > 3")->fetch_row()[0];

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
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
        nav {
            background-color: #333;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1, h2 {
            text-align: center;
        }
        p {
            font-size: 1.1em;
            margin: 10px 0;
        }

    </style>
</head>
<body>
    <header>
        <h1>Página de Gestión de Juegos</h1>
    </header>

    <nav>
        <ul>
            <li><a href="players.php">Gestionar Jugadores</a></li>
            <li><a href="games.php">Gestionar Juegos</a></li>
            <li><a href="matches.php">Gestionar Partidas</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Resumen de Control</h2>
        <p><strong>Número de juegos:</strong> <?php echo $gamesCount; ?></p>
        <p><strong>Número de jugadores:</strong> <?php echo $playersCount; ?></p>
        <p><strong>Número de partidas:</strong> <?php echo $matchesCount; ?></p>
        <p><strong>Jugadores jugando en 2 partidas:</strong> <?php echo $playersIn2Matches; ?></p>
        <p><strong>Jugadores jugando en 3 partidas:</strong> <?php echo $playersIn3Matches; ?></p>
        <p><strong>Jugadores jugando en más de 3 partidas:</strong> <?php echo $playersInMoreThan3Matches; ?></p>
    </div>
</body>
</html>
