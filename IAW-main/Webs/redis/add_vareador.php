<?php
require 'db.php';

// Verifica conexiones
if (!isset($conn)) {
    die("Error: La conexión a la base de datos no está definida.");
}
if (!isset($redis)) {
    die("Error: La conexión a Redis no está definida.");
}
echo "Conexión exitosa a la base de datos y Redis.<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        // Generar un ID temporal único
        $temp_id = "temp_vareador_" . uniqid();

        // Guardar en Redis con TTL de 60 segundos
        $redis->setex($temp_id, 60, json_encode(['nombre' => $nombre]));

        echo "Vareador almacenado en Redis con TTL de 60 segundos.<br>";

        header("Location: list_vareadores.php");
        exit;
    } else {
        echo "El nombre no puede estar vacío.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
