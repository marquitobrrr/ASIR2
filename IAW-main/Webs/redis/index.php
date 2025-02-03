<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vareadores y Olivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestión de Vareadores y Olivos</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Opciones</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="add_vareador.php" class="btn btn-primary">Agregar Vareador</a></li>
                    <li class="list-group-item"><a href="add_olivo.php" class="btn btn-primary">Agregar Olivo</a></li>
                    <li class="list-group-item"><a href="list_vareadores.php" class="btn btn-success">Ver Vareadores</a></li>
                    <li class="list-group-item"><a href="list_olivo.php" class="btn btn-success">Ver Olivos</a></li>
                    <li class="list-group-item"><a href="asignar_olivo.php" class="btn btn-danger"></a>Asignar olivo a vareador</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
