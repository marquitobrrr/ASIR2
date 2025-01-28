<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_superuser = isset($_POST['is_superuser']) ? 1 : 0;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, is_superuser) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $hashed_password, $is_superuser);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Error al registrar el usuario.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .register-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            padding: 30px;
            text-align: center;
        }

        h1 {
            color: #84fab0;
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

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            background: #84fab0;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #68d89b;
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
            color: #84fab0;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #68d89b;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Registro</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <label>
                <input type="checkbox" name="is_superuser"> ¿Es superusuario?
            </label>
            <button type="submit">Registrar</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
