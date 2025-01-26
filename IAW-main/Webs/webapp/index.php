<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_superuser = isset($_POST['is_superuser']) ? 1 : 0;

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insertar usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO users (username, password, is_superuser) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $hashed_password, $is_superuser);

    if ($stmt->execute()) {
        // Obtener el ID del usuario recién creado
        $user_id = $stmt->insert_id;

        // Iniciar sesión automáticamente
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['is_superuser'] = $is_superuser;

        // Redirigir al dashboard
        header("Location: dashboard.php");
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
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Nombre de usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <label>
            <input type="checkbox" name="is_superuser"> ¿Es superusuario?
        </label>
        <br>
        <button type="submit">Registrar</button>
    </form>
    <a href="index.php">Ya tengo una cuenta</a>
</body>
</html>
