<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los jugadores
$result = $conn->query("SELECT * FROM PLAYERS");

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Jugadores</title>
</head>
<body>
    <h1>Gestionar Jugadores</h1>
    <a href="insert_player.php">Agregar Jugador</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Alias</th>
            <th>Horas Jugadas</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID_PLAYERS']; ?></td>
                <td><?php echo $row['ALIAS']; ?></td>
                <td><?php echo $row['HOURS_IN_GAME']; ?></td>
                <td>
                    <a href="update_player.php?id=<?php echo $row['ID_PLAYERS']; ?>">Modificar</a>
                    <a href="delete_player.php?id=<?php echo $row['ID_PLAYERS']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
