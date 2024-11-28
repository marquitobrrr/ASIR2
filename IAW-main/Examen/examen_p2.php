<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pitufo - Página 2</title>
</head>
<body>
    <h1>Bienvenido al mundo de los Pitufos</h1>
    <form action="examen_p3.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_POST['nombre']); ?>" readonly><br><br>
        
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($_POST['apellidos']); ?>" readonly><br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>
        
        <label for="suerte">Número de la suerte (1-9):</label>
        <input type="number" id="suerte" name="suerte" min="1" max="9" required><br><br>
        
        <img src="img/<?php echo rand(1, 5); ?>.jpg" alt="Imagen aleatoria" style="display: block; margin: 0 auto;"><br>
        
        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($_POST['nombre']); ?>">
        <input type="hidden" name="apellidos" value="<?php echo htmlspecialchars($_POST['apellidos']); ?>">
        
        <button type="submit">Continuar</button>
    </form>
</body>
</html>