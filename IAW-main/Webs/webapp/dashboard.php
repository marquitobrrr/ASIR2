<?php
require 'db.php';
session_start();

// Verificar si el usuario está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener los datos del usuario logado
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$is_superuser = $_SESSION['is_superuser'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>

    <div style="float: right;">
        <p>Logeado como: <?php echo $is_superuser ? 'Superusuario' : 'Usuario común'; ?></p>
        <a href="login.php">Logout</a>
    </div>

    <?php if ($is_superuser): ?>
        <!-- Contenido exclusivo para superusuarios -->
        <h2>Opciones para Superusuarios</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Superusuario</th>
                <th>Acciones</th>
            </tr>
            <?php
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . ($row['is_superuser'] ? 'Sí' : 'No') . "</td>";
                echo "<td>
                        <a href='view_user.php?id=" . $row['id'] . "'>Ver</a> | 
                        <a href='edit_user.php?id=" . $row['id'] . "'>Editar</a> | 
                        <a href='delete_user.php?id=" . $row['id'] . "'>Borrar</a>
                      </td>";
                echo "</tr>";
            }
            $stmt->close();
            ?>
        </table>
    <?php else: ?>
        <!-- Contenido para usuarios comunes -->
        <h2>Opciones para Usuarios Comunes</h2>
        <ul>
            <li><a href="list_users.php">Ver Lista de Usuarios</a></li>
            <li><a href="game.php">Jugar al Juego Número Oculto</a></li>
            <li><a href="ranking.php">Ver Ranking</a></li>
        </ul>
    <?php endif; ?>
</body>
</html>
