<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM GAMES WHERE ID_GAME = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $developer = $_POST['developer'];

    $sql = "UPDATE GAMES SET NAME = '$name', DEVELOPERS = '$developer' WHERE ID_GAME = $id";
    $conn->query($sql);
    header('Location: games.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Juego</title>
</head>
<body>
    <h1>Modificar Juego</h1>
    <form method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo $row['NAME']; ?>" required><br>
        <label for="developer">Desarrollador:</label>
        <input type="text" name="developer" id="developer" value="<?php echo $row['DEVELOPERS']; ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
