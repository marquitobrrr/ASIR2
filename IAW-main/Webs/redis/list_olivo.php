<?php
require 'db.php';

// Clave de caché
$cacheKey = 'olivos_list';

// Verificar si los datos están en Redis
$olivos = getFromRedisCache($redis, $cacheKey);

if (!$olivos) {
    // Si no está en caché, consulta la base de datos
    $result = $conn->query("SELECT * FROM Olivos");
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    $olivos = $result->fetch_all(MYSQLI_ASSOC);

    // Guardar en Redis con TTL
    setRedisCache($redis, $cacheKey, $olivos, false);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Olivos</title>
</head>
<body>
    <h2>Olivos</h2>
    <ul>
        <?php 
        if (count($olivos) > 0) {
            foreach ($olivos as $row) {
                echo "<li>" . htmlspecialchars($row['ubicacion']) . " ";
                echo "<a href='delete.php?type=olivo&id=" . $row['id'] . "'>Eliminar</a>";
                echo "<a href='list_vareadores_olivo.php?olivo_id=" . $row['id'] . "'>Ver Vareadores</a>";
                echo "</li>";
            }
        } else {
            echo "<li>No hay olivos registrados.</li>";
        }
        ?>
    </ul>
    <a href="index.php">Volver</a>
</body>
</html>
