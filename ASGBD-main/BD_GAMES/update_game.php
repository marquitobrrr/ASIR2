<?php
$conn = new mysqli("localhost", "root", "232425", "BD_GAMES");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM GAMES WHERE ID_GAME = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $developer = $_POST['developer'];

    $sql = "UPDATE GAMES SET NAME = '$name', DEVELOPERS = '$developer' WHERE ID_GAME = $id";
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
    <title>Modificar Juego</title>
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
            max-width: 600px;
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
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Modificar Juego</h1>
    </header>

    <div class="container">
        <form method="post">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="<?php echo $row['NAME']; ?>" required>

            <label for="developer">Desarrollador:</label>
            <input type="text" name="developer" id="developer" value="<?php echo $row['DEVELOPERS']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
        <a href="games.php" class="btn-back">Volver a la Lista de Juegos</a>
    </div>
</body>
</html>
