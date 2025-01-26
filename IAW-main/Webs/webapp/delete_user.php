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

    // Borrar el usuario de la base de datos
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $success = "Usuario eliminado correctamente.";
    } else {
        $error = "Error al eliminar el usuario.";
    }
    $stmt->close();

    // Redirigir al dashboard con mensaje
    header("Location: dashboard.php");
    exit();
} else {
    // Si no se pasa un ID, redirigir al dashboard
    header("Location: dashboard.php");
    exit();
}
?>
