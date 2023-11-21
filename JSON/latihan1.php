<?php

// $mahasiswa = [
//     [
//     "nama" => "Faza",
//     "nim" => "068",
//     "prodi" => "Teknik Informatika"
//     ],
//     [
//     "nama" => "Izza",
//     "nim" => "032",
//     "prodi" => "Teknik Informatika"
//     ]
// ];

$dbh = new PDO('mysql:host=localhost;dbname=apifaza', 'root', '');
$db = $dbh->prepare('SELECT * FROM tb_mhs');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;
