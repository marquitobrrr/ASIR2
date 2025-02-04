<?php
require 'db.php';

if (!isset($_GET['olivo_id'])) {
    die("Error: No se especificó el ID del olivo.");
}

$olivo_id = intval($_GET['olivo_id']);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vareadores del Olivo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">
                <i class="fas fa-users"></i> Vareadores encargados del Olivo
            </h2>

            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle"></i> No hay vareadores asignados a este olivo.
                </div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="list_olivo.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a la lista de Olivos
                </a>
            </div>
        </div>
    </div>
</body>
</html>
