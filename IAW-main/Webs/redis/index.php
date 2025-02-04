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
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Gestión de Vareadores y Olivos</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="text-secondary text-center">Opciones</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="add_vareador.php" class="btn btn-primary w-100">Agregar Vareador</a>
                        </li>
                        <li class="list-group-item">
                            <a href="add_olivo.php" class="btn btn-primary w-100">Agregar Olivo</a>
                        </li>
                        <li class="list-group-item">
                            <a href="list_vareadores.php" class="btn btn-success w-100">Ver Vareadores</a>
                        </li>
                        <li class="list-group-item">
                            <a href="list_olivo.php" class="btn btn-success w-100">Ver Olivos</a>
                        </li>
                        <li class="list-group-item">
                            <a href="asignar_olivo.php" class="btn btn-danger w-100">Asignar olivo a vareador</a>
                        </li>
                        <li class="list-group-item">
                            <a href="modificar_asignacion.php" class="btn btn-danger w-100">Modificar la asignacion de olivos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
