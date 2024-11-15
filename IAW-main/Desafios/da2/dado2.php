<?php
// Recibiendo los parámetros desde dado1.php
$numDados = isset($_GET['numDados']) ? $_GET['numDados'] : 1;
$caras = isset($_GET['caras']) ? $_GET['caras'] : 6;
$puntosOponente = isset($_GET['puntosOponente']) ? $_GET['puntosOponente'] : 0;

// Lanzamiento de los dados
$resultados = [];
for ($i = 0; $i < $numDados; $i++) {
    $resultados[] = rand(1, $caras); // Generar número aleatorio entre 1 y el número de caras
}

$sumaResultados = array_sum($resultados);
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
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .result-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        p {
            font-size: 18px;
            text-align: center;
        }

        .result {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .winner {
            color: green;
        }

        .loser {
            color: red;
        }

        .draw {
            color: orange;
        }
    </style>
</head>
<body>

    <h1>Resultado de los Dados</h1>

    <div class="result-container">
        <p>Dados lanzados: <?php echo implode(", ", $resultados); ?></p>
        <p class="result">Puntos obtenidos: <?php echo $sumaResultados; ?></p>
        <p class="result">Puntos del oponente: <?php echo $puntosOponente; ?></p>

        <?php if ($sumaResultados > $puntosOponente): ?>
            <p class="winner">¡Has ganado!</p>
        <?php elseif ($sumaResultados < $puntosOponente): ?>
            <p class="loser">Has perdido.</p>
        <?php else: ?>
            <p class="draw">Es un empate.</p>
        <?php endif; ?>

        <p><a href="dado1.php">Volver a jugar</a></p>
    </div>

</body>
</html>
