<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_username = $_POST['username'];
        $new_is_superuser = isset($_POST['is_superuser']) ? 1 : 0;
        $new_password = $_POST['password'];

        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, is_superuser = ? WHERE id = ?");
            $stmt->bind_param("ssii", $new_username, $hashed_password, $new_is_superuser, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET username = ?, is_superuser = ? WHERE id = ?");
            $stmt->bind_param("sii", $new_username, $new_is_superuser, $user_id);
        }

        if ($stmt->execute()) {
            $success = "Usuario modificado correctamente.";
        } else {
            $error = "Error al modificar el usuario.";
        }
        $stmt->close();

        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            font-size: 1.5rem;
            color: #3498db;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        button {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background: #2980b9;
        }
        .success {
            color: green;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modificar Usuario</h1>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="is_superuser">
                <input type="checkbox" name="is_superuser" id="is_superuser" <?php echo $user['is_superuser'] ? 'checked' : ''; ?>>
                ¿Es superusuario?
            </label>

            <label for="password">Cambiar contraseña (opcional):</label>
            <input type="password" name="password" id="password" placeholder="Nueva contraseña">

            <button type="submit">Guardar Cambios</button>
        </form>
        <a href="dashboard.php" class="back-link">Volver al Dashboard</a>
    </div>
</body>
</html>
