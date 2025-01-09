<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM MATCHES");

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Partidas</title>
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
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .btn-add {
            background-color: #28a745;
        }
        .btn-edit {
            background-color: #ffc107;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-back {
            background-color: #6c757d;
        }

    </style>
</head>
<body>
    <header>
        <h1>Gestionar Partidas</h1>
    </header>

    <div class="container">
        <a href="index.php" class="btn btn-back">Volver al Inicio</a>
        <a href="insert_match.php" class="btn btn-add">Agregar Partida</a>

        <table>
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
                        <a href="update_match.php?id=<?php echo $row['ID_MATCH']; ?>" class="btn btn-edit">Modificar</a>
                        <a href="delete_match.php?id=<?php echo $row['ID_MATCH']; ?>" class="btn btn-delete">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
