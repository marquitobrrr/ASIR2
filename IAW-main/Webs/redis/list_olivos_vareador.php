<?php
require 'db.php';

// Verifica si se recibió el ID del vareador
if (!isset($_GET['vareador_id'])) {
    die("Error: No se especificó el ID del vareador.");
}

$vareador_id = intval($_GET['vareador_id']);

// Consulta para obtener los olivos de este vareador
$stmt = $conn->prepare("
    SELECT O.id, O.ubicacion 
    FROM Vareador_Olivo VO
    JOIN Olivos O ON VO.id_olivo = O.id
    WHERE VO.id_vareador = ?
");
$stmt->bind_param("i", $vareador_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Olivos del Vareador</title>
</head>
<body>
    <h2>Olivos a cargo del Vareador</h2>
    <ul>
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['ubicacion']) . "</li>";
            }
        } else {
            echo "<li>Este vareador no tiene olivos asignados.</li>";
        }
        ?>
    </ul>
    <a href="list_vareadores.php">Volver a la lista de Vareadores</a>
</body>
</html>
