<?php
error_reporting(1);
include "Client.php";

if($_POST['aksi'] == 'tambah'){
    $data = array("id_artis"=>$_POST['id_artis'],
                  "nama_artis"=>$_POST['nama_artis'],
                  "genre_lagu"=>$_POST['genre_lagu'], 
                  "production"=>$_POST['production'],
                  "popularitas"=>$_POST['popularitas'],
                  "aksi"=>$_POST['aksi']);
    $abc -> tambah_artis($data);
    header('location:index2.php?page=daftar-data');              
} else if ($_POST['aksi']=='ubah'){
    $data = array("id_artis"=>$_POST['id_artis'],
                  "nama_artis"=>$_POST['nama_artis'],
                  "genre_lagu"=>$_POST['genre_lagu'], 
                  "production"=>$_POST['production'],
                  "popularitas"=>$_POST['popularitas'],
                  "aksi"=>$_POST['aksi']);
    $abc -> ubah_artis($data);
    header('location:index2.php?page=daftar-data');               
} else if ($_GET['aksi']=='hapus'){
    $abc->hapus_artis($_GET['id_artis']);
    header('location:index2.php?page=daftar-data');
}  
unset($abc,$data);
?>
