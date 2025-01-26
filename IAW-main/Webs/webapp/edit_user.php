<?php
require 'db.php';
session_start();

// Verificar si el usuario está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Verificar si se pasa un ID
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Obtener los datos actuales del usuario
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Si se envía el formulario, actualizar los datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_username = $_POST['username'];
        $new_is_superuser = isset($_POST['is_superuser']) ? 1 : 0;

        $stmt = $conn->prepare("UPDATE users SET username = ?, is_superuser = ? WHERE id = ?");
        $stmt->bind_param("sii", $new_username, $new_is_superuser, $user_id);

        if ($stmt->execute()) {
            $success = "Usuario modificado correctamente.";
        } else {
            $error = "Error al modificar el usuario.";
        }
        $stmt->close();

        // Redirigir al dashboard
        header("Location: dashboard.php");
        exit();
    }
} else {
    // Si no se pasa un ID, redirigir al dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Usuario</title>
</head>
<body>
    <h1>Modificar Usuario</h1>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <label>
            <input type="checkbox" name="is_superuser" <?php echo $user['is_superuser'] ? 'checked' : ''; ?>> ¿Es superusuario?
        </label>
        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
