<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pitufo - Página 4</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .premio {
            font-size: 5em;
            margin: 20px 0;
        }
        .mensaje {
            font-size: 2em; 
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al mundo de los Pitufos</h1>
    <?php
    function calcularPremio($suerte) {
        $numeroAleatorio = rand(1, 10000);
        $multiplicador = rand(1, 5);
        return [
            'numeroAleatorio' => $numeroAleatorio,
            'premio' => 100 * $suerte * $multiplicador
        ];
    }

    if (isset($_POST['suerte'])) {
        $suerte = intval($_POST['suerte']); 

        $resultado = calcularPremio($suerte);
        $premio = $resultado['premio'];
        $mensaje = $premio > 3000 ? "Enhorabuena de la buena!" : "Enhoramala de la mala!";
    ?>
        <div class="premio">Tu premio es: <?php echo $premio; ?></div>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php
    } else {
        echo "<p>No se ha recibido el número de la suerte. Por favor, vuelve a intentarlo.</p>";
    }
    ?>
    <button onclick="window.location.reload();">Probar suerte de nuevo</button>
</body>
</html>