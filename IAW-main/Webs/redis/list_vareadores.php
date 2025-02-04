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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vareadores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Lista de Vareadores</h2>

            <?php if (count($vareadores) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vareadores as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td>
                                        <a href="delete.php?type=vareador&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                        <a href="list_olivos_vareador.php?vareador_id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Ver Olivos</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No hay Vareadores registrados.</div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
