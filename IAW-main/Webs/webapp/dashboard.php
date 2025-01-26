<?php
require 'db.php';
session_start();

// Verificar si el usuario está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener todos los usuarios para mostrarlos en la tabla
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Bienvenido, <?php echo $_SESSION['username']; ?> | <a href="index.php">Cerrar sesión</a></p>

    <h2>Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Superusuario</th>
            <th>Acciones</th>
        </tr>
        <?php while ($user = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['is_superuser'] ? 'Sí' : 'No'; ?></td>
            <td>
                <!-- Botón para borrar usuario -->
                <a href="delete_user.php?id=<?php echo $user['id']; ?>">Borrar</a>

                <!-- Botón para ver usuario -->
                <a href="view_user.php?id=<?php echo $user['id']; ?>">Ver</a>

                <!-- Botón para modificar usuario -->
                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Modificar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
