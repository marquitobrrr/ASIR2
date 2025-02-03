<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ubicacion = $_POST['ubicacion'];
    $stmt = $conn->prepare("INSERT INTO Olivos (ubicacion) VALUES (?)");
    $stmt->bind_param("s", $ubicacion);
    $stmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Agregar Olivo</title>
</head>
<body>
    <h2>Agregar Olivo</h2>
    <form method="POST">
        <input type="text" name="ubicacion" placeholder="Ubicación del Olivo" required>
        <button type="submit">Agregar</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>
