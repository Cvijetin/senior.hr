<?php
$apiKey = "122408c2c326fe8986353bd4f8be829a";
if(isset($_POST['Osijek'])){
    $cityId = 3193935;
}elseif (isset($_POST['Zagreb'])) {
    $cityId = 3337532;
} elseif (isset($_POST['Rijeka'])) {
    $cityId = 3188357;
} elseif (isset($_POST['Split'])) {
    $cityId = 3190261;
} elseif (isset($_POST['Dubrovnik'])) {
    $cityId = 3201047;
} else {
    $cityId = 3193935;
}
$googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?id=" . $cityId . "&units=metric&appid=" . $apiKey . "&cnt=15";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();

$googleApiUrl2 = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&units=metric&appid=" . $apiKey;

$ch2 = curl_init();

curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_URL, $googleApiUrl2);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch2, CURLOPT_VERBOSE, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
$response2 = curl_exec($ch2);

curl_close($ch2);
$data2 = json_decode($response2);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vrijeme</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e7382c972.js"></script>
</head>

<body>
    <header class="header-background-news">
        <div class="inline-left">
            <a class="left" href="../index.php"><i class="back fas fa-arrow-left"></i></a>
        </div>
        <div class="inline-right">
            <h1>Vrijeme</h1>
        </div>
    </header>
    <form action="weather.php" method="POST" id="weather">
        <div class="news-topic-wrapper">
            <div class="news-topic-icon">
                <input type="submit" name="Osijek" class="icon-text" id="news" value="Osijek">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="Zagreb" class="icon-text" id="new" value="Zagreb">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="Rijeka" class="icon-text" id="accident" value="Rijeka">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="Split" class="icon-text" id="sport" value="Split">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="Dubrovnik" class="icon-text" id="magazine" value="Dubrovnik">
            </div>
        </div>
    </form>

    <?php
    echo "<div class='weather-now-wrapper'>";
    echo "<h3>Trenutna temperatura</h3>";
        foreach ($data2->weather as $vrijeme) {
            echo "<div class='weather-image-wrapper'><img src='http://openweathermap.org/img/w/" . $vrijeme->icon . ".png'></div>";
        }
        echo "<h3>" . $data2->main->temp . "°C</h3>";
        echo "<h5>Vlažnost zraka: " . $data2->main->humidity . " %</h5>";
        echo "<h5>Brzina vjetra: " . $data2->wind->speed . " km/h</h5></div>";
    echo "</div>";
        ?>

    <main class="center">
    <h3>Prognoza za svaka 3h</h3>
        <?php
foreach ($data->list as $value) {
    echo "<div class='weather-wrapper'>";
        foreach ($value->weather as $vrijeme) {
            echo "<div class='weather-image-wrapper'><img src='http://openweathermap.org/img/w/" . $vrijeme->icon . ".png'></div>";
        }
        echo "<h3>" . $value->main->temp . "°C</h3>";
        echo "<div class='weather-description'><h5>" . $value->dt_txt . "</h5>";
        echo "<h5>Vlažnost zraka: " . $value->main->humidity . " %</h5>";
        echo "<h5>Brzina vjetra: " . $value->wind->speed . " km/h</h5></div>";
        
    echo "</div>";
}
?>

    </main>
</body>

</html>