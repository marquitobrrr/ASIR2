<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener las partidas
$result = $conn->query("SELECT * FROM MATCHES");

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Partidas</title>
</head>
<body>
    <h1>Gestionar Partidas</h1>
    <a href="insert_match.php">Agregar Partida</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Juego</th>
            <th>Jugador 1</th>
            <th>Jugador 2</th>
            <th>Nombre de la Partida</th>
            <th>Duración</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID_MATCH']; ?></td>
                <td><?php echo $row['ID_GAME']; ?></td>
                <td><?php echo $row['ID_PLAYER1']; ?></td>
                <td><?php echo $row['ID_PLAYER2']; ?></td>
                <td><?php echo $row['MATCH_NAME']; ?></td>
                <td><?php echo $row['MATCH_TIME']; ?></td>
                <td>
                    <a href="update_match.php?id=<?php echo $row['ID_MATCH']; ?>">Modificar</a>
                    <a href="delete_match.php?id=<?php echo $row['ID_MATCH']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
