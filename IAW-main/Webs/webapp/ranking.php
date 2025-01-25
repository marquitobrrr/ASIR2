<?php
require 'session.php';
checkSession();
require 'db.php';

$stmt = $pdo->query("SELECT username, score, created_at FROM ranking ORDER BY score ASC LIMIT 10");
$rankings = $stmt->fetchAll();
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
        <?php foreach ($rankings as $index => $row): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
