<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DADOS</title>
</head>
<body>

    <h1>DADOS</h1>
    
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

</body>
</html>

