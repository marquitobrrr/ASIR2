<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once 'db.php';

try {
    $stmt = $conn->prepare('SELECT username, score FROM ranking ORDER BY score DESC');
    $stmt->execute();
    $rankings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die('Error al obtener los datos del ranking: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking de Jugadores</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #8e44ad, #3498db);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 90%;
            padding: 20px 30px;
            text-align: center;
            color: #333;
        }
        h1 {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background: #3498db;
            color: #fff;
        }
        table tr:nth-child(even) {
            background: #f4f4f4;
        }
        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1rem;
            display: inline-block;
        }
        .back-btn:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ranking de Jugadores</h1>
        <?php if (!empty($rankings)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Usuario</th>
                        <th>Puntuación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rankings as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay datos en el ranking todavía.</p>
        <?php endif; ?>
        <a href="dashboard.php" class="back-btn">Volver al Dashboard</a>
    </div>
</body>
</html>
