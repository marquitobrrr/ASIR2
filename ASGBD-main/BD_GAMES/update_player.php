<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM PLAYERS WHERE ID_PLAYERS = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alias = $_POST['alias'];
    $hours = $_POST['hours'];

    $sql = "UPDATE PLAYERS SET ALIAS = '$alias', HOURS_IN_GAME = $hours WHERE ID_PLAYERS = $id";
    $conn->query($sql);
    header('Location: players.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Jugador</title>
</head>
<body>
    <h1>Modificar Jugador</h1>
    <form method="post">
        <label for="alias">Alias:</label>
        <input type="text" name="alias" id="alias" value="<?php echo $row['ALIAS']; ?>" required><br>
        <label for="hours">Horas Jugadas:</label>
        <input type="number" name="hours" id="hours" value="<?php echo $row['HOURS_IN_GAME']; ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
