<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Conectar a la base de datos SQLite
$db = new SQLite3('/home/alumno/databases/prueba.db');

// Ejecutar una consulta SELECT
$resultado = $db->query('SELECT * FROM empleados');

// Iterar sobre los resultados y mostrarlos
while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
    echo "Nombre: " . $fila['nombre'] . " - Salario: " . $fila['salario'] . "<br>";
}

// Cerrar la conexión a la base de datos
$db->close();
?>