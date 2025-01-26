<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener lista de nombres de usuarios
$stmt = $conn->prepare("SELECT username FROM users");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($row['username']); ?></li>
        <?php endwhile; ?>
    </ul>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
