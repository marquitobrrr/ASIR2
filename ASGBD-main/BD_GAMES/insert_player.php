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
    <title>Agregar Jugador</title>
</head>
<body>
    <h1>Agregar Jugador</h1>
    <form method="post">
        <label for="alias">Alias:</label>
        <input type="text" name="alias" id="alias" required><br>
        <label for="hours">Horas Jugadas:</label>
        <input type="number" name="hours" id="hours" required><br>
        <button type="submit">Agregar Jugador</button>
    </form>
</body>
</html>
