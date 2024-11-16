<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Aleatorio: Números y Semáforo Secuencial</title>
    <style>
        /* Estilos del semáforo */
        .semaforo {
            width: 100px;
            height: 300px;
            background-color: black;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            margin-top: 50px;
        }
        .luz {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: gray;
        }
        .rojo {
            background-color: red;
        }
        .amarillo {
            background-color: yellow;
        }
        .verde {
            background-color: green;
        }
        /* Estilo para los números */
        .numeros {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- PRIMER CÓDIGO: Números aleatorios -->
<?php 
    // Generamos los números aleatorios
    $num1 = rand(1, 99);
    $num2 = rand(1, 99);
    $num3 = rand(1, 99);
    $num4 = rand(1, 99);

    // Calculamos la suma y la media
    $suma = $num1 + $num2 + $num3 + $num4;
    $media = $suma / 4;
?>

<!-- Bloque para los números aleatorios -->
<div class="numeros">
    <h2>Números Aleatorios</h2>
    <ul>
        <li><?php echo $num1; ?></li>
        <li><?php echo $num2; ?></li>
        <li><?php echo $num3; ?></li>
        <li><?php echo $num4; ?></li>
    </ul>

    <!-- Mostramos la suma y la media -->
    <p style="color: purple;">Suma: <?php echo $suma; ?></p>
    <p style="color: purple;">Media: <?php echo $media; ?></p>
</div>

<!-- SEGUNDO CÓDIGO: Semáforo secuencial -->
<?php
    // Obtener el estado actual del semáforo
    // Creamos un ciclo con estados de 1 a 3: 1 es Rojo, 2 es Verde, 3 es Amarillo
    session_start(); // Iniciamos la sesión para mantener el estado
    if (!isset($_SESSION['estado'])) {
        $_SESSION['estado'] = 1; // Comenzamos en Rojo
    } else {
        // Avanzamos al siguiente estado del ciclo (1 → 2 → 3 → 1...)
        $_SESSION['estado'] = ($_SESSION['estado'] % 3) + 1;
    }

    // Asignamos las clases de colores dependiendo del estado
    $rojo = '';
    $amarillo = '';
    $verde = '';

    switch ($_SESSION['estado']) {
        case 1:
            $rojo = 'rojo'; // Estado 1: Rojo encendido
            break;
        case 2:
            $verde = 'verde'; // Estado 2: Verde encendido
            break;
        case 3:
            $amarillo = 'amarillo'; // Estado 3: Amarillo encendido
            break;
    }
?>

<!-- Estructura del semáforo -->
<h2>Semáforo Secuencial</h2>
<div class="semaforo">
    <!-- Se imprimen las luces en el orden fijo pero con colores cambiantes -->
    <div class="luz <?php echo $rojo; ?>"></div>
    <div class="luz <?php echo $verde; ?>"></div>
    <div class="luz <?php echo $amarillo; ?>"></div>
</div>

</body>
</html>
