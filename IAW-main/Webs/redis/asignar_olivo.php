<?php
require 'db.php';


$resultVareadores = $conn->query("SELECT * FROM Vareadores");
$vareadores = $resultVareadores->fetch_all(MYSQLI_ASSOC);

$resultOlivos = $conn->query("SELECT * FROM Olivos");
$olivos = $resultOlivos->fetch_all(MYSQLI_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vareador = intval($_POST['id_vareador']);
    $id_olivo = intval($_POST['id_olivo']);

    if ($id_vareador > 0 && $id_olivo > 0) {
        $stmt = $conn->prepare("INSERT INTO Vareador_Olivo (id_vareador, id_olivo) VALUES (?, ?)");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }
        $stmt->bind_param("ii", $id_vareador, $id_olivo);
        $stmt->execute();
        $stmt->close();

        if (isset($redis)) {
            $redis->del("vareadores_list");
            $redis->del("olivos_list");
        }

        echo "<script>
                alert('Olivo asignado correctamente.');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        $error = "Seleccione un Vareador y un Olivo válidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Olivo a Vareador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Asignar Olivo a Vareador</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="id_vareador" class="form-label">Selecciona un Vareador:</label>
                    <select name="id_vareador" id="id_vareador" class="form-select" required>
                        <option value="">-- Seleccionar --</option>
                        <?php foreach ($vareadores as $vareador): ?>
                            <option value="<?= $vareador['id'] ?>"><?= htmlspecialchars($vareador['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_olivo" class="form-label">Selecciona un Olivo:</label>
                    <select name="id_olivo" id="id_olivo" class="form-select" required>
                        <option value="">-- Seleccionar --</option>
                        <?php foreach ($olivos as $olivo): ?>
                            <option value="<?= $olivo['id'] ?>"><?= htmlspecialchars($olivo['ubicacion']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Asignar Olivo</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
