<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los juegos
$result = $conn->query("SELECT * FROM GAMES");

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Juegos</title>
</head>
<body>
    <h1>Gestionar Juegos</h1>
    <a href="insert_game.php">Agregar Juego</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Desarrollador</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID_GAME']; ?></td>
                <td><?php echo $row['NAME']; ?></td>
                <td><?php echo $row['DEVELOPERS']; ?></td>
                <td>
                    <a href="update_game.php?id=<?php echo $row['ID_GAME']; ?>">Modificar</a>
                    <a href="delete_game.php?id=<?php echo $row['ID_GAME']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
