<?php
// Clave de API de OpenWeatherMap (reemplaza 'TU_CLAVE_DE_API' con tu clave real)
$api_key = '4efb595c2fd9bb679ee46bccca492dfa';

// Obtener la ciudad desde el formulario
$city = isset($_GET['city']) ? $_GET['city'] : '';

if ($city) {
    // URL de la API de OpenWeatherMap
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=4efb595c2fd9bb679ee46bccca492dfa";

    // Inicializar cURL
    $ch = curl_init();

    // Establecer opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud HTTP
    $response = curl_exec($ch);

    // Verificar si hubo errores en la solicitud
    if ($response === false) {
        // Obtener el código de error de cURL
        $error = curl_error($ch);
        $result = "Error en cURL: $error";
    } else {
        // Obtener el código de respuesta HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code == 200) {
            // Decodificar la respuesta JSON
            $data = json_decode($response, true);

            // Verificar si se recibieron datos válidos
            if (isset($data['main']) && isset($data['weather'])) {
                // Extraer los datos del clima
                $temperature = $data['main']['temp'];
                $description = $data['weather'][0]['description'];
                $humidity = $data['main']['humidity'];
                $wind_speed = $data['wind']['speed'];
                $icon = $data['weather'][0]['icon'];

                // Formatear los resultados
                $result = "<h2>Clima en " . htmlspecialchars($city) . "</h2>";
                $result .= "<img class='weather-icon' src='http://openweathermap.org/img/wn/$icon@2x.png' alt='Ícono del clima'><br>";
                $result .= "Temperatura: " . $temperature . " °C<br>";
                $result .= "Descripción: " . ucfirst($description) . "<br>";
                $result .= "Humedad: " . $humidity . " %<br>";
                $result .= "Velocidad del viento: " . $wind_speed . " m/s<br>";
            } else {
                // Manejar el error
                $result = "Error al procesar la respuesta JSON";
            }
        } elseif ($http_code == 401) {
            $result = "Error: No autorizado. Verifica tu clave de API.";
        } else {
            $result = "Error: Código de respuesta HTTP $http_code";
        }
    }

    // Cerrar cURL
    curl_close($ch);
} else {
    $result = "Por favor, ingresa el nombre de una ciudad.";
}

// Redirigir de vuelta a index.php con los resultados
header("Location: index.php?result=" . urlencode($result));
exit();
?>