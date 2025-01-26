<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_superuser = isset($_POST['is_superuser']) ? 1 : 0;

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO users (username, password, is_superuser) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $hashed_password, $is_superuser);

    if ($stmt->execute()) {
        // Redirigir al login después del registro exitoso
        header('Location: index.php');
        exit();
    } else {
        $error = "Error al registrar el usuario.";
    }

    $stmt->close();
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
            <input type="checkbox" name="is_superuser"> ¿Es superusuario?
        </label>
        <button type="submit">Registrar</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>

    <!-- Botón para ir al login si ya tienes cuenta -->
    <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
</body>
</html>
