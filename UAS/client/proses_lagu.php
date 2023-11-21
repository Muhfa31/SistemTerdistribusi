<?php
error_reporting(1);
include "Client.php";

if($_POST['aksi'] == 'tambah'){
    $data = array("id_lagu"=>$_POST['id_lagu'],
                  "id_artis"=>$_POST['id_artis'],
                  "id_album"=>$_POST['id_album'], 
                  "nama_lagu"=>$_POST['nama_lagu'],
                  "tahun_rilis"=>$_POST['tahun_rilis'],
                  "aksi"=>$_POST['aksi']);
    $lagu -> tambah_data($data);
    header('location:index.php?page=daftar-data');              
} else if ($_POST['aksi']=='ubah'){
    $data = array("id_artis"=>$_POST['id_artis'],
                  "id_artis"=>$_POST['id_artis'],
                  "id_album"=>$_POST['id_album'], 
                  "nama_lagu"=>$_POST['nama_lagu'],
                  "tahun_rilis"=>$_POST['tahun_rilis'],
                  "aksi"=>$_POST['aksi']);
    $lagu -> ubah_data($data);
    header('location:index.php?page=daftar-data');               
} else if ($_GET['aksi']=='hapus'){
    $lagu->hapus_data($_GET['id_lagu']);
    header('location:index.php?page=daftar-data');
}  
unset($lagu,$data);
?>
