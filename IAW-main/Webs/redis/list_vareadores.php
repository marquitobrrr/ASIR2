<?php
require 'db.php';

// Clave de caché
$cacheKey = 'vareadores_list';

// Verificar si los datos están en Redis
$vareadores = getFromRedisCache($redis, $cacheKey);

if (!$vareadores) {
    // Si no está en caché, consulta la base de datos
    $result = $conn->query("SELECT * FROM Vareadores");
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    $vareadores = $result->fetch_all(MYSQLI_ASSOC);

    // Guardar en Redis con TTL
    setRedisCache($redis, $cacheKey, $vareadores, false);
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
        if (count($vareadores) > 0) {
            foreach ($vareadores as $row) {
                echo "<li>" . htmlspecialchars($row['nombre']) . " ";
                echo "<a href='delete.php?type=vareador&id=" . $row['id'] . "'>Eliminar</a>";
                echo "<a href='list_olivos_vareador.php?vareador_id=" . $row['id'] . "'>Ver Olivos</a>";
                echo "</li>";
            }
        } else {
            echo "<li>No hay Vareadores registrados.</li>";
        }
        ?>
    </ul>
    <a href="index.php">Volver</a>
</body>
</html>
