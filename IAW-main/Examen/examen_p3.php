<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pitufo - Página 3</title>
</head>
<body>
    <h1>Bienvenido al mundo de los Pitufos</h1>
    <ol>
        <li>Nombre: <?php echo htmlspecialchars($_POST['nombre']); ?></li>
        <li>Apellidos: <?php echo htmlspecialchars($_POST['apellidos']); ?></li>
        <li>Edad: <?php echo htmlspecialchars($_POST['edad']); ?></li>
        <li>Número de la suerte: <?php echo htmlspecialchars($_POST['suerte']); ?></li>
    </ol>
    
    <form action="examen_p4.php" method="post">
        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($_POST['nombre']); ?>">
        <input type="hidden" name="apellidos" value="<?php echo htmlspecialchars($_POST['apellidos']); ?>">
        <input type="hidden" name="edad" value="<?php echo htmlspecialchars($_POST['edad']); ?>">
        <input type="hidden" name="suerte" value="<?php echo htmlspecialchars($_POST['suerte']); ?>">
        
        <button type="submit">Suerte</button>
    </form>
</body>
</html>