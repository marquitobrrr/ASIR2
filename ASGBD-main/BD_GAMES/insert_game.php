<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $developer = $_POST['developer'];

    $sql = "INSERT INTO GAMES (NAME, DEVELOPERS) VALUES ('$name', '$developer')";
    $conn->query($sql);
    header('Location: games.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Juego</title>
</head>
<body>
    <h1>Agregar Juego</h1>
    <form method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="developer">Desarrollador:</label>
        <input type="text" name="developer" id="developer" required><br>
        <button type="submit">Agregar Juego</button>
    </form>
</body>
</html>
