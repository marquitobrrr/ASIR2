<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números Aleatorios</title>
</head>
<body>

    <h1>Números aleatorios del 1 al 99</h1>

    <?php
    // Generar y mostrar 4 líneas con números aleatorios
    for ($i = 0; $i < 4; $i++) {
        $numero = rand(1, 99); // Generar número aleatorio entre 1 y 99
        echo "<p>Línea " . ($i + 1) . ": $numero</p>";
    }
    ?>

    <button onclick="location.reload();">Generar nuevos números</button>

</body>
</html>

