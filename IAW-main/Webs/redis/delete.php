<?php
require 'db.php';

if (!isset($_GET['type']) || !isset($_GET['id'])) {
    die("Error: Faltan parámetros para la eliminación.");
}

$type = $_GET['type'];
$id = intval($_GET['id']); // Asegurar que es un número entero

if ($type == "vareador") {
    $stmt = $conn->prepare("DELETE FROM Vareadores WHERE id = ?");
    $cacheKey = "vareadores_list"; // Clave de caché en Redis
    $redirectPage = "list_vareadores.php";
} elseif ($type == "olivo") {
    $stmt = $conn->prepare("DELETE FROM Olivos WHERE id = ?");
    $cacheKey = "olivos_list"; // Clave de caché en Redis
    $redirectPage = "list_olivo.php";
} else {
    die("Error: Tipo de eliminación no válido.");
}

if (!$stmt) {
    die("Error en la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo ucfirst($type) . " eliminado correctamente.<br>";

    // Eliminar caché en Redis para asegurarse de que los cambios se reflejan
    $redis->del($cacheKey);
    echo "Caché de $type eliminada en Redis.<br>";

    // Redirigir a la página de lista y forzar recarga
    echo "<script>
            alert('{$type} eliminado correctamente.');
            window.location.href = '{$redirectPage}';
          </script>";
} else {
    echo "No se pudo eliminar el $type.<br>";
}

$stmt->close();
?>
