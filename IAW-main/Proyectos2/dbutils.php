<?php
function conectarDB(): PDO {

    $db = new PDO(dsn: "mysql:host=localhost;dbname=DB_EVA2;", username: "root", password: "232425");
    $db->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
    return $db;
}

function realizarQuery($conexion, $texto, $argumentos=null, $isFetch=false): mixed 

{
    $command = $conexion -> prepare($texto);
    $command -> execute($argumentos);
    if($isFetch) return $command -> fetchAll();
}
?>