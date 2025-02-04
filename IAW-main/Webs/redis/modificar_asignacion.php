<?php
require 'db.php';

// Obtener todas las asignaciones actuales
$query = "SELECT Vareador_Olivo.id_vareador, Vareador_Olivo.id_olivo, 
                 Vareadores.nombre AS vareador_nombre, Olivos.ubicacion AS olivo_ubicacion
          FROM Vareador_Olivo
          JOIN Vareadores ON Vareador_Olivo.id_vareador = Vareadores.id
          JOIN Olivos ON Vareador_Olivo.id_olivo = Olivos.id";
$resultAsignaciones = $conn->query($query);
$asignaciones = $resultAsignaciones->fetch_all(MYSQLI_ASSOC);

// Obtener lista de Olivos para reasignación
$resultOlivos = $conn->query("SELECT * FROM Olivos");
$olivos = $resultOlivos->fetch_all(MYSQLI_ASSOC);

// Procesar la modificación de la asignación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vareador = intval($_POST['id_vareador']);
    $id_olivo_actual = intval($_POST['id_olivo_actual']);
    $id_olivo_nuevo = intval($_POST['id_olivo']);

    if ($id_vareador > 0 && $id_olivo_nuevo > 0 && $id_olivo_actual > 0) {
        $stmt = $conn->prepare("UPDATE Vareador_Olivo SET id_olivo = ? WHERE id_vareador = ? AND id_olivo = ?");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }
        $stmt->bind_param("iii", $id_olivo_nuevo, $id_vareador, $id_olivo_actual);
        $stmt->execute();
        $stmt->close();

        // Eliminar caché en Redis si está definido
        if (isset($redis)) {
            $redis->del("vareadores_list");
            $redis->del("olivos_list");
        }

        // Redirigir y recargar la página automáticamente
        echo "<script>
                alert('Asignación modificada correctamente.');
                window.location.href = window.location.href;
              </script>";
        exit;
    } else {
        $error = "Seleccione valores válidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Asignación de Olivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Modificar Asignación de Olivos</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if (count($asignaciones) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Vareador</th>
                                <th>Olivo Actual</th>
                                <th>Nuevo Olivo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asignaciones as $asignacion): ?>
                                <tr>
                                    <td><?= htmlspecialchars($asignacion['vareador_nombre']) ?></td>
                                    <td><?= htmlspecialchars($asignacion['olivo_ubicacion']) ?></td>
                                    <td>
                                        <form method="POST" class="d-flex">
                                            <input type="hidden" name="id_vareador" value="<?= $asignacion['id_vareador'] ?>">
                                            <input type="hidden" name="id_olivo_actual" value="<?= $asignacion['id_olivo'] ?>">
                                            <select name="id_olivo" class="form-select me-2" required>
                                                <option value="">-- Seleccionar --</option>
                                                <?php foreach ($olivos as $olivo): ?>
                                                    <option value="<?= $olivo['id'] ?>" <?= $olivo['id'] == $asignacion['id_olivo'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($olivo['ubicacion']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-success btn-sm">Modificar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No hay asignaciones registradas.</div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
