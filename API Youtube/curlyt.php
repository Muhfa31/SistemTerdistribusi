<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UClvpelIT-VF1U_A33yaAVEg&key=AIzaSyBo1gqyt-q-Cx4AG0e3RKLL-doYc0HYjgg");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);

$ytProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];

$ytNameChannel = $result['items'][0]['snippet']['title'];
$ytSubs =  $result['items'][0]['statistics']['subscriberCount'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Sosmed</a>
        <button class="navbar-toggler" type="button" 
        data-toggle="collapse" data-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" 
        aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="card" style="width: 18rem;">
        <img src="<?= $ytProfilePic ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $ytNameChannel ?></h5>
            <p class="card-text">Subscriber : <?= $ytSubs ?></p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>