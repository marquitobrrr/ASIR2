<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pitufo - Página 4</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        h1 {
            font-size: 5em;
        }
        .enhorabuena {
            font-size: 2em;
        }
    </style>
</head>
<body>
    <?php
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $edad = htmlspecialchars($_POST['edad']);
    $suerte = htmlspecialchars($_POST['suerte']);
    $premio = 100 * $suerte * rand(1, 5); 
    ?>
    
    <h1><?php echo $premio; ?></h1>
    <?php if ($premio > 3000): ?>
        <div class="enhorabuena">¡Enhorabuena de la buena!</div>
    <?php endif; ?>
    
    <form action="index.php" method="post">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>">
        <input type="hidden" name="edad" value="<?php echo $edad; ?>">
        <input type="hidden" name="suerte" value="<?php echo $suerte; ?>">
        
        <button type="submit">Probar suerte de nuevo</button>
    </form>
</body>
</html>