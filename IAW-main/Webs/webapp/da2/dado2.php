<?php

$numDados = isset($_GET['numDados']) ? intval($_GET['numDados']) : 1;
$caras = isset($_GET['caras']) ? intval($_GET['caras']) : 6; 
$puntosOponente = isset($_GET['puntosOponente']) ? intval($_GET['puntosOponente']) : 0; 

$imagenes = [
    4 => '/ASIR2/IAW-main/Desafios/da2/dados/4k.png',
    6 => '/ASIR2/IAW-main/Desafios/da2/dados/6k.png',
    8 => '/ASIR2/IAW-main/Desafios/da2/dados/8k.png',
    12 => '/ASIR2/IAW-main/Desafios/da2/dados/12k.png',
    20 => '/ASIR2/IAW-main/Desafios/da2/dados/20k.png'
];

$imagenSeleccionada = isset($imagenes[$caras]) ? $imagenes[$caras] : $imagenes[6]; 

$puntuacionTotal = 0;
$puntuaciones = [];
for ($i = 0; $i < $numDados; $i++) {
    $puntuacion = rand(1, $caras);
    $puntuaciones[] = $puntuacion;
    $puntuacionTotal += $puntuacion;
}


if ($puntuacionTotal > $puntosOponente) {
    $resultado = "VICTORIA!!!";
    $colorResultado = "green";
} else {
    $resultado = "DERROTA!!!";
    $colorResultado = "red";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de los Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .result-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 600px;
        }

        img {
            max-width: 100px;
            height: auto;
            margin: 5px;
        }

        h1, h2, p {
            color: #333;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .puntuaciones {
            margin-top: 10px;
            font-size: 18px;
            color: #555;
        }

        .dados-container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .resultado {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="result-container">
        <h1>Resultado de los Dados</h1>  
        <h2>Dado de <?php echo $caras; ?> caras</h2>
        <div class="dados-container">
            <?php for ($i = 0; $i < $numDados; $i++): ?>
                <img src="<?php echo $imagenSeleccionada; ?>" alt="Dado de <?php echo $caras; ?> caras">
            <?php endfor; ?>
        </div>
        <p>Has lanzado <?php echo $numDados; ?> dado(s).</p>
        <p class="puntuaciones">Puntuaciones obtenidas: <?php echo implode(", ", $puntuaciones); ?></p>
        <p class="puntuaciones">Puntuación total: <strong><?php echo $puntuacionTotal; ?></strong></p>
        <p class="puntuaciones">Puntos del oponente: <strong><?php echo $puntosOponente; ?></strong></p>

        <p class="resultado" style="color: <?php echo $colorResultado; ?>;">
            <?php echo $resultado; ?>
        </p>

        <a class="back-link" href="dado1.php">Volver a elegir otro dado</a>
    </div>

</body>
</html>
