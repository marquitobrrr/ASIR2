<?php
require 'db.php';
session_start();

// Verificar y actualizar contraseñas no encriptadas al iniciar
function updatePlainPasswords($conn) {
    $result = $conn->query("SELECT id, password FROM users");
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $plain_password = $row['password'];

        // Verificar si la contraseña está en texto plano (no tiene estructura de hash)
        if (!password_get_info($plain_password)['algo']) {
            // Encriptar la contraseña y actualizarla en la base de datos
            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();
        }
    }
}

// Actualizar contraseñas si es necesario
updatePlainPasswords($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_superuser'] = $user['is_superuser'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <a href="index.php">Crear una cuenta</a>
</body>
</html>
