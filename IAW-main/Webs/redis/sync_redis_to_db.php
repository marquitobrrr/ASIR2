<?php
require 'db.php';

// Obtener todas las claves temporales de vareadores en Redis
$temp_keys = $redis->keys("temp_vareador_*");

if (empty($temp_keys)) {
    echo "No hay datos para sincronizar.<br>";
} else {
    foreach ($temp_keys as $key) {
        $data = json_decode($redis->get($key), true);

        if ($data) {
            $nombre = $data['nombre'];

            // Insertar en la base de datos
            $stmt = $conn->prepare("INSERT INTO Vareadores (nombre) VALUES (?)");
            if (!$stmt) {
                die("Error en la consulta: " . $conn->error);
            }

            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $stmt->close();

            echo "Vareador '$nombre' añadido a la base de datos.<br>";

            // Eliminar de Redis después de escribir en la base de datos
            $redis->del($key);
        }
    }
    echo "Sincronización completada.";
}
?>
