<?php
session_start();

function checkSession() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
    $_SESSION['last_activity'] = time();
}
?>
