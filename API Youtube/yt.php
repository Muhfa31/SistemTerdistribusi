<?php
$json_url = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UClvpelIT-VF1U_A33yaAVEg&key=AIzaSyBo1gqyt-q-Cx4AG0e3RKLL-doYc0HYjgg";
$json = file_get_contents($json_url);
$data = json_decode($json, true);

// var_dump($data);

echo 'Channel : ' .$data['items'][0]['snippet']['title'].'<br>';
echo 'Subs : ' .$data['items'][0]['statistics']['subscriberCount'];
