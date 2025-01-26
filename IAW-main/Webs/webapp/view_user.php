<?php
require 'db.php';
session_start();

// Verificar si el usuario está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Verificar si se pasa un ID
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Obtener datos del usuario
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    // Si no se pasa un ID, redirigir al dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Usuario</title>
</head>
<body>
    <h1>Ver Usuario</h1>
    <p>ID: <?php echo $user['id']; ?></p>
    <p>Usuario: <?php echo $user['username']; ?></p>
    <p>Superusuario: <?php echo $user['is_superuser'] ? 'Sí' : 'No'; ?></p>

    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
