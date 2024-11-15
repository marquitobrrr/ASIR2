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
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* Estilo del dado */
        .dado {
            width: 100px;
            height: 100px;
            display: inline-block;
            background-color: #ffffff;
            border: 2px solid #333;
            border-radius: 10px;
            position: relative;
            margin: 10px;
        }

        /* Para dado de 6 caras */
        .cara {
            font-size: 40px;
            font-weight: bold;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Personalizar los dados según el número de caras */
        .cara-4 .cara {
            font-size: 30px;
        }
        .cara-6 .cara {
            font-size: 40px;
        }
        .cara-8 .cara {
            font-size: 30px;
        }
        .cara-10 .cara {
            font-size: 30px;
        }
        .cara-12 .cara {
            font-size: 25px;
        }
        .cara-20 .cara {
            font-size: 20px;
        }

        .result {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
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

        .back-link {
            display: block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Resultado de los Dados</h1>

    <div class="result-container">
        <p><strong>Dados lanzados:</strong></p>
        <div class="dados">
            <?php foreach ($resultados as $resultado): ?>
                <div class="dado cara-<?php echo $caras; ?>">
                    <div class="cara"><?php echo $resultado; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="result">Puntos obtenidos: <?php echo $sumaResultados; ?></p>
        <p class="result">Puntos del oponente: <?php echo $puntosOponente; ?></p>

        <?php if ($sumaResultados > $puntosOponente): ?>
            <p class="winner">¡Has ganado!</p>
        <?php elseif ($sumaResultados < $puntosOponente): ?>
            <p class="loser">Has perdido.</p>
        <?php else: ?>
            <p class="draw">Es un empate.</p>
        <?php endif; ?>

        <a class="back-link" href="dado1.php">Volver a jugar</a>
    </div>

</body>
</html>

