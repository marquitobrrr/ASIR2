<?php
require 'db.php';

if (!isset($_GET['type']) || !isset($_GET['id'])) {
    die("Error: Faltan parámetros para la eliminación.");
}

$type = $_GET['type'];
$id = intval($_GET['id']); 

if ($type == "vareador") {
    $stmt = $conn->prepare("DELETE FROM Vareadores WHERE id = ?");
    $cacheKey = "vareadores_list"; 
    $redirectPage = "list_vareadores.php";
} elseif ($type == "olivo") {
    $stmt = $conn->prepare("DELETE FROM Olivos WHERE id = ?");
    $cacheKey = "olivos_list";
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

    $redis->del($cacheKey);
    echo "Caché de $type eliminada en Redis.<br>";

    echo "<script>
            alert('{$type} eliminado correctamente.');
            window.location.href = '{$redirectPage}';
          </script>";
} else {
    echo "No se pudo eliminar el $type.<br>";
}

$stmt->close();
?>
