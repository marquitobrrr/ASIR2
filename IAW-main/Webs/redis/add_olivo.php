<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ubicacion = $_POST['ubicacion'];
    $stmt = $conn->prepare("INSERT INTO Olivos (ubicacion) VALUES (?)");
    $stmt->bind_param("s", $ubicacion);
    $stmt->execute();
    header("Location: add_olivo.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Olivo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Agregar Olivo</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación del Olivo</label>
                    <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ingrese la ubicación" required>
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
