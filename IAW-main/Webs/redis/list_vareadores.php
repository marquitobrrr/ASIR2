<?php
require 'db.php';

// Verifica si la conexión a la base de datos y Redis están definidas
if (!isset($conn)) {
    die("Error: La conexión a la base de datos no está definida.");
}
if (!isset($redis)) {
    die("Error: La conexión a Redis no está definida.");
}

// Clave de caché
$cacheKey = 'vareadores_list';

// Verificar si los datos están en Redis
if ($redis->exists($cacheKey)) {
    $vareadores = json_decode($redis->get($cacheKey), true);
    echo "<p>Obteniendo datos desde Redis...</p>";
} else {
    // Si no está en caché, consulta la base de datos
    echo "<p>Obteniendo datos desde la base de datos...</p>";
    $result = $conn->query("SELECT * FROM Vareadores");
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    $vareadores = $result->fetch_all(MYSQLI_ASSOC);

    // Guardar en Redis con TTL
    $redis->setex($cacheKey, 60, json_encode($vareadores));
}

// Verificar si la consulta devuelve datos
if (empty($vareadores)) {
    echo "<p>No hay vareadores registrados en la base de datos.</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vareadores</title>
</head>
<body>
    <h2>Vareadores</h2>
    <ul>
        <?php 
        if (!empty($vareadores)) {
            foreach ($vareadores as $row) {
                echo "<li>" . htmlspecialchars($row['nombre']) . " ";
                echo "<a href='delete.php?type=vareador&id=" . $row['id'] . "'>Eliminar</a> ";
                echo "<a href='list_olivos_vareador.php?vareador_id=" . $row['id'] . "'>Ver Olivos</a>";
                echo "</li>";
            }
        } else {
            echo "<li>No hay vareadores registrados.</li>";
        }
        ?>
    </ul>
    <a href="index.php">Volver</a>
</body>
</html>
