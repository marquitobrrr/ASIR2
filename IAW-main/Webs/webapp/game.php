<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['reset'])) {
    unset($_SESSION['random_number']);
    unset($_SESSION['attempts']);
    unset($_SESSION['history']);
    unset($_SESSION['game_over']);
    header('Location:game.php'); 
    exit();
}


if (!isset($_SESSION['random_number'])) {
    $_SESSION['random_number'] = rand(1, 100); 
    $_SESSION['attempts'] = 0;
    $_SESSION['history'] = [];
    $_SESSION['game_over'] = false; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$_SESSION['game_over']) {
    $_SESSION['attempts']++;
    $guess = (int)$_POST['guess'];

    if ($guess === $_SESSION['random_number']) {
        $success = true;

        require_once 'db.php';

        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $user_id = $user['id'];

            $stmt = $conn->prepare('UPDATE ranking SET score = score + 1 WHERE user_id = ?');
            $stmt->bind_param('i', $user_id);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                $stmt = $conn->prepare('INSERT INTO ranking (user_id, username, score) VALUES (?, ?, 1)');
                $stmt->bind_param('is', $user_id, $_SESSION['username']);
                $stmt->execute();
            }

            $_SESSION['game_over'] = true;
        }
    } elseif ($_SESSION['attempts'] >= 5) {
        $_SESSION['game_over'] = true;
        $lost = true;
    } else {
        if ($guess > $_SESSION['random_number']) {
            $feedback = 'El número es más bajo.';
            $_SESSION['history'][] = "$guess - Demasiado alto";
        } else {
            $feedback = 'El número es más alto.';
            $_SESSION['history'][] = "$guess - Demasiado bajo";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego: Adivina el Número</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .game-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
            padding: 20px 30px;
            text-align: center;
        }
        h1 {
            color: #4facfe;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
        }
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #4facfe;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #007bff;
        }
        .history {
            margin-top: 20px;
            text-align: left;
        }
        .history ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .history li {
            background: #f7f7f7;
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.9rem;
        }
        .feedback {
            margin-top: 20px;
            font-weight: bold;
            color: #4facfe;
        }
        .success {
            color: green;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .lost {
            color: red;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .buttons-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .buttons-container form {
            width: 48%;
        }
        .buttons-container button {
            padding: 10px;
            width: 100%;
            border-radius: 10px;
            font-size: 1rem;
        }
        .retry-btn {
            background: #4caf50;
            color: #fff;
        }
        .dashboard-btn {
            background: #f44336;
            color: #fff;
        }
        .retry-btn:hover {
            background: #43a047;
        }
        .dashboard-btn:hover {
            background: #e53935;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Juego: Adivina el Número</h1>
        <?php if (!isset($success) && !isset($lost)): ?>
            <form method="POST">
                <input type="number" name="guess" placeholder="Ingresa tu número" required>
                <button type="submit">Adivinar</button>
            </form>
            <?php if (isset($feedback)): ?>
                <p class="feedback"><?php echo htmlspecialchars($feedback); ?></p>
            <?php endif; ?>
            <div class="history">
                <h3>Historial de Intentos:</h3>
                <ul>
                    <?php if (!empty($_SESSION['history'])): ?>
                        <?php foreach ($_SESSION['history'] as $attempt): ?>
                            <li><?php echo htmlspecialchars($attempt); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No hay intentos registrados todavía.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <p>Intentos restantes: <?php echo 5 - $_SESSION['attempts']; ?></p>
        <?php elseif (isset($success)): ?>
            <p class="success">¡Felicidades! Has acertado el número y ganaste 1 punto.</p>
        <?php elseif (isset($lost)): ?>
            <p class="lost">Lo siento, has alcanzado el límite de intentos. ¡Has perdido!</p>
        <?php endif; ?>
        <div class="buttons-container">
            <form method="post">
                <input type="hidden" name="reset" value="true">
                <button type="submit" class="retry-btn">Volver a Empezar</button>
            </form>
            <form action="dashboard.php" method="get">
                <button type="submit" class="dashboard-btn">Volver al Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>
