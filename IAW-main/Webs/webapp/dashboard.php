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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .dashboard-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 850px;
            width: 95%;
            padding: 30px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #4facfe;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .user-info {
            align-self: flex-end;
            font-size: 1rem;
            margin-top: -15px;
        }

        .user-info p {
            margin: 0;
        }

        .user-info a {
            text-decoration: none;
            color: #4facfe;
            font-weight: bold;
        }

        .user-info a:hover {
            color: #007bff;
        }

        .table-container {
            margin-top: 30px;
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        th {
            background-color: #4facfe;
            color: #fff;
        }

        td {
            background-color: #f7f7f7;
        }

        .actions a {
            margin: 0 5px;
            color: #4facfe;
            text-decoration: none;
        }

        .actions a:hover {
            color: #007bff;
        }

        .options {
            margin-top: 30px;
            width: 100%;
            text-align: left;
        }

        .options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .options li {
            margin: 10px 0;
        }

        .options a {
            display: inline-block;
            text-decoration: none;
            background: #4facfe;
            padding: 10px 0px;
            color: white;
            border-radius: 10px;
            font-size: 1rem;
            transition: background 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .options a:hover {
            background: #007bff;
        }

    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>

        <?php if ($is_superuser): ?>
            <h2>Opciones para Superusuarios</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Superusuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM users");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . ($row['is_superuser'] ? 'Sí' : 'No') . "</td>";
                            echo "<td class='actions'>
                                    <a href='view_user.php?id=" . $row['id'] . "'>Ver</a> | 
                                    <a href='edit_user.php?id=" . $row['id'] . "'>Editar</a> | 
                                    <a href='delete_user.php?id=" . $row['id'] . "'>Borrar</a>
                                  </td>";
                            echo "</tr>";
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            <div class="options">
                <ul>
                    <li><a href="login.php">Cerrar sesión</a></li>
                </ul>
            </div>
            </div>
        <?php else: ?>
            <h2>Opciones para Usuarios Comunes</h2>
            <div class="options">
                <ul>
                    <li><a href="list_users.php">Ver Lista de Usuarios</a></li>
                    <li><a href="game.php">Jugar al Juego Número Oculto</a></li>
                    <li><a href="ranking.php">Ver Ranking</a></li>
                    <li><a href="login.php">Cerrar sesión</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
