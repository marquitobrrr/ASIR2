<?php
require 'db.php';

$cacheKey = 'olivos_list';

$olivos = getFromRedisCache($redis, $cacheKey);

if (!$olivos) {
    $result = $conn->query("SELECT * FROM Olivos");
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    $olivos = $result->fetch_all(MYSQLI_ASSOC);

    setRedisCache($redis, $cacheKey, $olivos, false);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Olivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Lista de Olivos</h2>
            
            <?php if (count($olivos) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($olivos as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ubicacion']) ?></td>
                                    <td>
                                        <a href="delete.php?type=olivo&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                        <a href="list_vareadores_olivo.php?olivo_id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ver Vareadores</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No hay olivos registrados.</div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
