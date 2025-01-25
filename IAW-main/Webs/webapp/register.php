<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_superuser = isset($_POST['is_superuser']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO users (username, password, is_superuser) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$username, $password, $is_superuser]);
        header('Location: index.php');
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <label>
            <input type="checkbox" name="is_superuser"> Superusuario
        </label>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
