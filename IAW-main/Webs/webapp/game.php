<?php
require 'session.php';
checkSession();
require 'db.php';

$randomNumber = rand(1, 100);
$attempts = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = (int)$_POST['guess'];
    $attempts = (int)$_POST['attempts'] + 1;

    if ($guess === $randomNumber) {
        $user_id = $_SESSION['user_id'];

        // Guardar el juego como completado
        $stmt = $pdo->prepare("INSERT INTO games (user_id, attempts, completed) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $attempts, true]);

        // Guardar en ranking si el usuario quiere
        if (isset($_POST['save_ranking']) && $_POST['save_ranking'] === 'yes') {
            $stmt = $pdo->prepare("INSERT INTO ranking (user_id, username, score) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $_SESSION['username'], $attempts]);
        }

        echo "<p>¡Felicidades! Adivinaste en $attempts intentos.</p>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Juego</title>
</head>
<body>
    <h1>Juego del Número Oculto</h1>
    <form method="post">
        <input type="number" name="guess" required>
        <input type="hidden" name="attempts" value="<?= $attempts ?>">
        <button type="submit">Probar</button>
    </form>
</body>
</html>
