<?php
require 'db.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['type'] == 'vareador') {
        $stmt = $conn->prepare("DELETE FROM Vareadores WHERE id = ?");
    } elseif ($_GET['type'] == 'olivo') {
        $stmt = $conn->prepare("DELETE FROM Olivos WHERE id = ?");
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
}
?>
