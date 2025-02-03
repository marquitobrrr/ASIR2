<?php
require 'db.php';

// Obtener lista de Vareadores
$resultVareadores = $conn->query("SELECT * FROM Vareadores");
$vareadores = $resultVareadores->fetch_all(MYSQLI_ASSOC);

// Obtener lista de Olivos
$resultOlivos = $conn->query("SELECT * FROM Olivos");
$olivos = $resultOlivos->fetch_all(MYSQLI_ASSOC);

// Procesar la asignación
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

        // Eliminar caché en Redis
        $redis->del("vareadores_list");
        $redis->del("olivos_list");

        echo "<script>
                alert('Olivo asignado correctamente.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<p style='color:red;'>Seleccione un Vareador y un Olivo válidos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Olivo a Vareador</title>
</head>
<body>
    <h2>Asignar Olivo a Vareador</h2>
    <form method="POST">
        <label>Selecciona un Vareador:</label>
        <select name="id_vareador" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($vareadores as $vareador): ?>
                <option value="<?= $vareador['id'] ?>"><?= htmlspecialchars($vareador['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        
        <label>Selecciona un Olivo:</label>
        <select name="id_olivo" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($olivos as $olivo): ?>
                <option value="<?= $olivo['id'] ?>"><?= htmlspecialchars($olivo['ubicacion']) ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        
        <button type="submit">Asignar Olivo</button>
    </form>
    <br>
    <a href="index.php">Volver</a>
</body>
</html>
