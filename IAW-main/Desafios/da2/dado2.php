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
    <title>Resultado de los Dados en 3D</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
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
            text-align: center;
        }

        /* Estilo del dado en 3D */
        .dado {
            width: 100px;
            height: 100px;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(30deg) rotateY(45deg);
            margin: 0 auto; /* Centrar el dado */
            margin-bottom: 20px; /* Espacio entre los dados */
        }

        .cara {
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Definir las caras en 3D */
        .cara-1  { transform: rotateY(  0deg) translateZ(50px); }
        .cara-2  { transform: rotateY( 90deg) translateZ(50px); }
        .cara-3  { transform: rotateY(180deg) translateZ(50px); }
        .cara-4  { transform: rotateY(270deg) translateZ(50px); }
        .cara-5  { transform: rotateX( 90deg) translateZ(50px); }
        .cara-6  { transform: rotateX(-90deg) translateZ(50px); }

        /* Ajuste del dado según el número de caras */
        .dado-4 {
            transform: scale(0.6);
            width: 80px;
            height: 80px;
        }
        .dado-6 {
            transform: scale(1);
        }
        .dado-8 {
            transform: scale(0.8);
            width: 90px;
            height: 90px;
        }
        .dado-10 {
            transform: scale(0.7);
            width: 90px;
            height: 90px;
        }
        .dado-12 {
            transform: scale(0.9);
            width: 95px;
            height: 95px;
        }
        .dado-20 {
            transform: scale(1.1);
            width: 110px;
            height: 110px;
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

    <h1>Resultado de los Dados en 3D</h1>

    <div class="result-container">
        <p><strong>Dados lanzados:</strong></p>
        <div class="dados">
            <?php foreach ($resultados as $resultado): ?>
                <div class="dado dado-<?php echo $caras; ?>">
                    <div class="cara cara-1"><?php echo $resultado; ?></div>
                    <div class="cara cara-2"><?php echo $resultado; ?></div>
                    <div class="cara cara-3"><?php echo $resultado; ?></div>
                    <div class="cara cara-4"><?php echo $resultado; ?></div>
                    <div class="cara cara-5"><?php echo $resultado; ?></div>
                    <div class="cara cara-6"><?php echo $resultado; ?></div>
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
