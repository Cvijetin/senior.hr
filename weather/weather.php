<?php
$apiKey = "122408c2c326fe8986353bd4f8be829a";
$cityId = "3193935";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&units=metric&cnt=5&appid=" . $apiKey;

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
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index.hr vijesti</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e7382c972.js"></script>
</head>

<body>
    <header class="header-background-news">
        <div class="inline-left">
            <a class="left" href="../index.php"><i class="back fas fa-arrow-left"></i></a>
        </div>
        <div class="inline-right">
            <h1>Ostali portali</h1>
        </div>
    </header>

    <main>
        <div class="report-container">
            <h2><?php echo $data->name; ?></h2>
            <div class="time">
                <div><?php echo date("l g:i a", $currentTime); ?></div>
                <div><?php echo date("jS F, Y",$currentTime); ?></div>
                <div><?php echo ucwords($data->weather[0]->description); ?></div>
            </div>
            <div class="weather-forecast">
                <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                    class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                    class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
            </div>
            <div class="time">
                <div>Vlažnost zraka: <?php echo $data->main->humidity; ?> %</div>
                <div>Vjetar: <?php echo $data->wind->speed; ?> km/h</div>
            </div>
        </div>
    </main>

</body>

</html>