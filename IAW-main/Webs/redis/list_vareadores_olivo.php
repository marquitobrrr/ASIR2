<?php
require 'db.php';

// Verifica si se recibió el ID del olivo
if (!isset($_GET['olivo_id'])) {
    die("Error: No se especificó el ID del olivo.");
}

$olivo_id = intval($_GET['olivo_id']);

// Consulta para obtener los vareadores asignados a este olivo
$stmt = $conn->prepare("
    SELECT V.id, V.nombre 
    FROM Vareador_Olivo VO
    JOIN Vareadores V ON VO.id_vareador = V.id
    WHERE VO.id_olivo = ?
");
$stmt->bind_param("i", $olivo_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vareadores del Olivo</title>
</head>
<body>
    <h2>Vareadores encargados del Olivo</h2>
    <ul>
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['nombre']) . "</li>";
            }
        } else {
            echo "<li>No hay vareadores asignados a este olivo.</li>";
        }
        ?>
    </ul>
    <a href="list_olivo.php">Volver a la lista de Olivos</a>
</body>
</html>
