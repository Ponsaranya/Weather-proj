<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <style>
        body {
            background-color: black;
            color: white; /* Set text color to white */
            font-family: Arial, sans-serif; /* Optional: Set font family */
            padding: 20px; /* Optional: Add padding for better readability */
            text-align:center;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['lat']) && isset($_GET['lon'])) {
        $latitude = htmlspecialchars($_GET['lat']);
        $longitude = htmlspecialchars($_GET['lon']);
        $apiKey = '3ca74e0e331e003d7065cb7e1474ae94'; // Replace with your actual API key
        $weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid=$apiKey&units=metric";
        
        $weatherData = @file_get_contents($weatherApiUrl);
        
        if ($weatherData === FALSE) {
            $error = error_get_last();
            echo "Error fetching weather data: " . $error['message'];
        } else {
            $weatherData = json_decode($weatherData);
            if ($weatherData) {
                $location = $weatherData->name; // City name or location name
                $temperature = $weatherData->main->temp;
                $weatherDescription = $weatherData->weather[0]->description;
                
                echo "<h2>Location: $location</h2>";
                echo "<p>Latitude: $latitude</p>";
                echo "<p>Longitude: $longitude</p>";
                echo "<p>Temperature: $temperature °C</p>";
                echo "<p>Weather: $weatherDescription</p>";
            } else {
                echo "Error decoding weather data.";
            }
        }
    } else {
        echo "Latitude and longitude not provided.";
    }
    ?>
    <a href="index.php" id="link"><center>Go to Main Page</center></a>
</body>
</html>
