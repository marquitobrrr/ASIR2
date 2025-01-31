<?php
// Conexión a MariaDB
$mysqli = new mysqli("localhost", "usuario", "contraseña", "Agricultura");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Conexión a Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Función para obtener todos los vareadores
function obtenerVareadores($mysqli, $redis) {
    $clave = "vareadores";
    if ($redis->exists($clave)) {
        return json_decode($redis->get($clave), true);
    } else {
        $resultado = $mysqli->query("SELECT * FROM Vareadores");
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        $redis->setex($clave, 60, json_encode($datos));
        return $datos;
    }
}

// Función para obtener todos los olivos
function obtenerOlivos($mysqli, $redis) {
    $clave = "olivos";
    if ($redis->exists($clave)) {
        return json_decode($redis->get($clave), true);
    } else {
        $resultado = $mysqli->query("SELECT * FROM Olivos");
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        $redis->setex($clave, 60, json_encode($datos));
        return $datos;
    }
}

// Función para obtener los olivos de un vareador
function obtenerOlivosDeVareador($mysqli, $redis, $id_vareador) {
    $clave = "olivos_vareador_$id_vareador";
    if ($redis->exists($clave)) {
        return json_decode($redis->get($clave), true);
    } else {
        $stmt = $mysqli->prepare("SELECT Olivos.* FROM Olivos INNER JOIN Vareador_Olivo ON Olivos.id = Vareador_Olivo.id_olivo WHERE Vareador_Olivo.id_vareador = ?");
        $stmt->bind_param("i", $id_vareador);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        $redis->setex($clave, 60, json_encode($datos));
        return $datos;
    }
}

// Función para obtener los vareadores de un olivo
function obtenerVareadoresDeOlivo($mysqli, $redis, $id_olivo) {
    $clave = "vareadores_olivo_$id_olivo";
    if ($redis->exists($clave)) {
        return json_decode($redis->get($clave), true);
    } else {
        $stmt = $mysqli->prepare("SELECT Vareadores.* FROM Vareadores INNER JOIN Vareador_Olivo ON Vareadores.id = Vareador_Olivo.id_vareador WHERE Vareador_Olivo.id_olivo = ?");
        $stmt->bind_param("i", $id_olivo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        $redis->setex($clave, 60, json_encode($datos));
        return $datos;
    }
}

?>
