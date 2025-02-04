<?php
require 'db.php';

if (!isset($_GET['vareador_id'])) {
    die("Error: No se especificó el ID del vareador.");
}

$vareador_id = intval($_GET['vareador_id']);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olivos del Vareador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Olivos a cargo del Vareador</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['ubicacion']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">Este vareador no tiene olivos asignados.</div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="list_vareadores.php" class="btn btn-secondary">Volver a la lista de Vareadores</a>
            </div>
        </div>
    </div>
</body>
</html>
