<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $stmt = $conn->prepare("INSERT INTO Vareadores (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();

    // Invalidar la caché de Vareadores en Redis
    $redis->del('vareadores_list');

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Agregar Vareador</title>
</head>
<body>
    <h2>Agregar Vareador</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre del Vareador" required>
        <button type="submit">Agregar</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>
