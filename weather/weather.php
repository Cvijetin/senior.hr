<?php
$apiKey = "122408c2c326fe8986353bd4f8be829a";
$cityId = "3193935";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?id=" . $cityId . "&units=metric&appid=" . $apiKey;

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

    </main>

 



<div class="vrijeme">
<?php
foreach ($data->list as $value) {

    echo "<p>" . $value->main->temp . "</p>" . "</br>";

    foreach ($value->weather as $vrijeme) {
        echo "<p>" . $vrijeme->description . "</p>" . "</br>";
       echo "<img src='http://openweathermap.org/img/w/" . $vrijeme->icon . ".png'";
    }

    echo "<p>" . $value->dt_txt . "</p>" . "</br>";
    echo "<hr>";
}
?>

</div>






</body>

</html>