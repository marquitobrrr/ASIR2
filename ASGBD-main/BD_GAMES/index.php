<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "BD_GAMES";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el resumen de control
$gamesCount = $conn->query("SELECT COUNT(*) FROM GAMES")->fetch_row()[0];
$playersCount = $conn->query("SELECT COUNT(*) FROM PLAYERS")->fetch_row()[0];
$matchesCount = $conn->query("SELECT COUNT(*) FROM MATCHES")->fetch_row()[0];

// Obtener el número de jugadores en 2, 3 o más partidas
$playersIn2Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) = 2")->fetch_row()[0];
$playersIn3Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) = 3")->fetch_row()[0];
$playersInMoreThan3Matches = $conn->query("SELECT COUNT(DISTINCT ID_PLAYER1) FROM MATCHES GROUP BY ID_PLAYER1 HAVING COUNT(ID_PLAYER1) > 3")->fetch_row()[0];

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Página de Gestión de Juegos</h1>

    <nav>
        <ul>
            <li><a href="players.php">Gestionar Jugadores</a></li>
            <li><a href="games.php">Gestionar Juegos</a></li>
            <li><a href="matches.php">Gestionar Partidas</a></li>
        </ul>
    </nav>

    <h2>Resumen de Control</h2>
    <p>Número de juegos: <?php echo $gamesCount; ?></p>
    <p>Número de jugadores: <?php echo $playersCount; ?></p>
    <p>Número de partidas: <?php echo $matchesCount; ?></p>
    <p>Jugadores jugando en 2 partidas: <?php echo $playersIn2Matches; ?></p>
    <p>Jugadores jugando en 3 partidas: <?php echo $playersIn3Matches; ?></p>
    <p>Jugadores jugando en más de 3 partidas: <?php echo $playersInMoreThan3Matches; ?></p>
</body>
</html>
