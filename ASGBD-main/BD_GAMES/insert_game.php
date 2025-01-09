<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $developer = $_POST['developer'];

    $sql = "INSERT INTO GAMES (NAME, DEVELOPERS) VALUES ('$name', '$developer')";
    $conn->query($sql);
    header('Location: games.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Juego</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-back {
            display: block;
            margin: 10px 0;
            padding: 10px;
            text-align: center;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <header>
        <h1>Agregar Juego</h1>
    </header>

    <div class="container">
        <a href="games.php" class="btn-back">Volver a la Lista de Juegos</a>
        <form method="post">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>

            <label for="developer">Desarrollador:</label>
            <input type="text" name="developer" id="developer" required>

            <button type="submit">Agregar Juego</button>
        </form>
    </div>
</body>
</html>
