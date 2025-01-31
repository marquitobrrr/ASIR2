<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "232425";
$dbname = "Agricultura";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function getVareadores($conn, $redis) {
    $cacheKey = 'vareadores';
    if ($redis->exists($cacheKey)) {
        return json_decode($redis->get($cacheKey), true);
    }
    $result = $conn->query("SELECT * FROM Vareadores");
    $vareadores = $result->fetch_all(MYSQLI_ASSOC);
    $redis->setex($cacheKey, 60, json_encode($vareadores)); // 60 segundos
    return $vareadores;
}

function getOlivos($conn, $redis) {
    $cacheKey = 'olivos';
    if ($redis->exists($cacheKey)) {
        return json_decode($redis->get($cacheKey), true);
    }
    $result = $conn->query("SELECT * FROM Olivos");
    $olivos = $result->fetch_all(MYSQLI_ASSOC);
    $redis->setex($cacheKey, 60, json_encode($olivos)); // 60 segundos
    return $olivos;
}

// Agregar un Vareador
if (isset($_POST['add_vareador'])) {
    $nombre = $_POST['nombre'];
    $stmt = $conn->prepare("INSERT INTO Vareadores (nombre) VALUES (?)");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $redis->del('vareadores'); // Invalida la caché
    header("Location: index.php");
}

// Agregar un Olivo
if (isset($_POST['add_olivo'])) {
    $ubicacion = $_POST['ubicacion'];
    $stmt = $conn->prepare("INSERT INTO Olivos (ubicacion) VALUES (?)");
    $stmt->bind_param("s", $ubicacion);
    $stmt->execute();
    $redis->del('olivos'); // Invalida la caché
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vareadores y Olivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestión de Vareadores y Olivos</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Vareadores</h3>
                <form method="POST">
                    <input type="text" name="nombre" placeholder="Nombre del Vareador" class="form-control" required>
                    <button type="submit" name="add_vareador" class="btn btn-primary mt-2">Agregar</button>
                </form>
                <ul class="list-group mt-3">
                    <?php foreach (getVareadores($conn, $redis) as $vareador): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($vareador['nombre']) ?>
                            <a href="delete.php?type=vareador&id=<?= $vareador['id'] ?>" class="btn btn-danger btn-sm float-end">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Olivos</h3>
                <form method="POST">
                    <input type="text" name="ubicacion" placeholder="Ubicación del Olivo" class="form-control" required>
                    <button type="submit" name="add_olivo" class="btn btn-primary mt-2">Agregar</button>
                </form>
                <ul class="list-group mt-3">
                    <?php foreach (getOlivos($conn, $redis) as $olivo): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($olivo['ubicacion']) ?>
                            <a href="delete.php?type=olivo&id=<?= $olivo['id'] ?>" class="btn btn-danger btn-sm float-end">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>