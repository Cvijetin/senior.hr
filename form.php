
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prijedlozi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/5e7382c972.js"></script>
</head>

<body>
    <header class="header-background-news">
        <div class="inline-left">
            <a class="left" href="index.php"><i class="back fas fa-arrow-left"></i></a>
        </div>
        <div class="inline-right">
            <h1>Prijedlozi</h1>
        </div>
    </header>

    <div class="container">
        <form action="form-handler.php" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="fname">Ime:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="first_name" placeholder="Ovdje upišite Vaše ime..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lname">Prezime:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="last_name" placeholder="Ovdje upišite Vaše prezime..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Email:</label>
                </div>
                <div class="col-75">
                    <input type="email" id="email" name="email" placeholder="Ovdje upišite Vaš email..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="title">Naslov poruke:</label>
                </div>
                <div class="col-75">
                    <textarea id="message" name="message" placeholder="Ovdje napišite tekst poruke.."
                        style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="form-submit" name="submit" value="Pošalji">
            </div>
        </form>
    </div>

</body>

</html>