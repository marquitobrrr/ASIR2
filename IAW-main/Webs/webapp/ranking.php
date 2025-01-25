<?php
require 'session.php';
checkSession();
require 'db.php';

$result = $conn->query("SELECT username, score, created_at FROM ranking ORDER BY score ASC LIMIT 10");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ranking</title>
</head>
<body>
    <h1>Ranking</h1>
    <table border="1">
        <tr>
            <th>Posición</th>
            <th>Usuario</th>
            <th>Puntuación</th>
            <th>Fecha</th>
        </tr>
        <?php $pos = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $pos++ ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
