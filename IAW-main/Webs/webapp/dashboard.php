<?php
require 'session.php';
checkSession();
require 'db.php';

$is_superuser = $_SESSION['is_superuser'];

if ($is_superuser) {
    echo "<h1>Bienvenido, Superusuario {$_SESSION['username']}</h1>";
    echo "<a href='logout.php'>Cerrar sesión</a> | <a href='game_history.php'>Historial de Juegos</a>";

    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll();

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Usuario</th><th>Acciones</th></tr>";
    foreach ($users as $user) {
        echo "<tr>
                <td>{$user['id']}</td>
                <td>{$user['username']}</td>
                <td>
                    <a href='delete_user.php?id={$user['id']}'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<h1>Bienvenido, Usuario {$_SESSION['username']}</h1>";
    echo "<a href='game.php'>Jugar</a> | <a href='ranking.php'>Ranking</a> | <a href='logout.php'>Cerrar sesión</a>";
}
?>
