<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DADOS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-size: 16px;
            margin-top: 10px;
            display: block;
        }
        select, input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>DADOS</h1>
    
    <div class="form-container">
        <form action="" method="POST">
            <label for="numDados">Número de Dados:</label>
            <select name="numDados" id="numDados">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <label for="caras">Número de Caras:</label>
            <select name="caras" id="caras">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
                <option value="20">20</option>
            </select>

            <label for="puntosOponente">Puntos Oponente:</label>
            <input type="number" name="puntosOponente" id="puntosOponente" required>

            <button type="submit" name="submit">Lanzar Dados</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $numDados = $_POST['numDados'];
            $caras = $_POST['caras'];
            $puntosOponente = $_POST['puntosOponente'];

            // Simulación del lanzamiento de dados
            $resultados = [];
            for ($i = 0; $i < $numDados; $i++) {
                $resultados[] = rand(1, $caras); // Generar número aleatorio entre 1 y el número de caras
            }

            $sumaResultados = array_sum($resultados);

            echo "<h3>Resultado del Lanzamiento:</h3>";
            echo "Dados lanzados: " . implode(", ", $resultados) . "<br>";
            echo "Suma de los resultados: $sumaResultados<br>";

            // Comparación con los puntos del oponente
            if ($sumaResultados > $puntosOponente) {
                echo "¡Has ganado!<br>";
            } elseif ($sumaResultados < $puntosOponente) {
                echo "Has perdido.<br>";
            } else {
                echo "Es un empate.<br>";
            }
        }
        ?>
    </div>

</body>
</html>
