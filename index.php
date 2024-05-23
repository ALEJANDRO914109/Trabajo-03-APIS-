<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clima de la Ciudad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #000000;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #FFFFFF;
            text-align: center;
        }
        h1 {
            color: #FFFFFF;
        }
        label {
            font-size: 1.2em;
            color: #FFFFFF;
        }
        input[type="text"] {
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            width: calc(100% - 24px);
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #fffff;
        }
        .result {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consulta el clima de una ciudad</h1>
        <form action="weather.php" method="GET">
            <label for="city">Ciudad:</label>
            <input type="text" id="city" name="city" required>
            <button type="submit">Consultar</button>
        </form>
        <div class="result">
            <?php if (isset($_GET['result'])): ?>
                <?= $_GET['result']; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>