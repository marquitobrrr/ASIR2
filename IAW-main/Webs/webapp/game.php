<?php
require 'db.php';
session_start();

// Verificar si el usuario está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Inicializar variables
$message = "";
$generated_number = null;

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_guess = intval($_POST['user_guess']);
    $generated_number = rand(1, 10); // Generar un número aleatorio entre 1 y 10

    if ($user_guess === $generated_number) {
        $message = "¡Felicidades! Has acertado el número $generated_number.";
        
        // Verificar si el usuario ya tiene una entrada en la tabla ranking
        $stmt = $conn->prepare("SELECT * FROM ranking WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si existe, actualizar el puntaje
            $stmt = $conn->prepare("UPDATE ranking SET score = score + 1 WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
        } else {
            // Si no existe, crear una nueva entrada en el ranking
            $stmt = $conn->prepare("INSERT INTO ranking (user_id, username, score) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $user_id, $username, $score);
            $score = 1;
            $stmt->execute();
        }
    } else {
        $message = "Lo siento, no has acertado. El número era $generated_number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Juego Número Oculto</title>
</head>
<body>
    <h1>Juego Número Oculto</h1>
    <p>Introduce un número del 1 al 10:</p>
    <form method="post">
        <input type="number" name="user_guess" min="1" max="10" required>
        <button type="submit">Adivinar</button>
    </form>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
