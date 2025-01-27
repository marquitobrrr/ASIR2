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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #a18cd1, #fbc2eb);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .login-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            padding: 30px;
            text-align: center;
        }

        h1 {
            color: #a18cd1;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            width: 100%;
        }

        button {
            background: #a18cd1;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #9053c7;
        }

        .error {
            color: #ff6b6b;
            margin-top: 10px;
        }

        p {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        a {
            color: #a18cd1;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #9053c7;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <p>¿No tienes una cuenta? <a href="index.php">Crear una cuenta</a></p>
    </div>
</body>
</html>
