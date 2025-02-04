<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $stmt = $conn->prepare("INSERT INTO Vareadores (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();

    if (isset($redis)) {
        $redis->del('vareadores_list');
    }

    header("Location: add_vareador.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vareador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Agregar Vareador</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Vareador</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
