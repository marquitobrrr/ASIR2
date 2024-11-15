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

        /* Estilo base del dado */
        .dado {
            display: inline-block;
            margin: 10px;
            padding: 20px;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            color: white;
        }

        /* Dado de 4 caras */
        .dado-4 {
            background-color: #007BFF;
            border-radius: 15px;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotate(45deg); /* Simula una pirámide en 2D */
        }

        /* Dado de 6 caras */
        .dado-6 {
            background-color: #28a745;
            border-radius: 15px;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Dado de 8 caras */
        .dado-8 {
            background-color: #ffc107;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); /* Octágono */
        }

        /* Dado de 10 caras */
        .dado-10 {
            background-color: #dc3545;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: polygon(50% 0%, 100% 10%, 100% 90%, 50% 100%, 0% 90%, 0% 10%); /* Decágono */
        }

        /* Dado de 12 caras */
        .dado-12 {
            background-color: #17a2b8;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: polygon(50% 0%, 100% 8%, 100% 92%, 50% 100%, 0% 92%, 0% 8%); /* 12-gon */
        }

        /* Dado de 20 caras */
        .dado-20 {
            background-color: #6610f2;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: polygon(50% 0%, 100% 5%, 100% 95%, 50% 100%, 0% 95%, 0% 5%); /* icoságono */
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
                <div class="dado dado-<?php echo $caras; ?>">
                    <div class="numero"><?php echo $resultado; ?></div>
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