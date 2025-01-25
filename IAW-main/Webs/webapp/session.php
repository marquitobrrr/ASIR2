<?php
session_start();

// Redirigir al login si no hay usuario logueado
function checkSession() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }

    // Expirar la sesión después de 5 minutos de inactividad
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
    $_SESSION['last_activity'] = time();
}
?>
