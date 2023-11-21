<?php
error_reporting(1);
include "Client.php";

if($_POST['aksi'] == 'tambah'){
    $data = array("id_album"=>$_POST['id_album'],
                  "id_artis"=>$_POST['id_artis'],
                  "nama_album"=>$_POST['nama_album'], 
                  "tanggal_rilis"=>$_POST['tanggal_rilis'],
                  "deskripsi"=>$_POST['deskripsi'],
                  "aksi"=>$_POST['aksi']);
    $album -> tambah_data($data);
    header('location:index.php?page=daftar-data');              
} else if ($_POST['aksi']=='ubah'){
    $data = array("id_album"=>$_POST['id_album'],
                  "id_artis"=>$_POST['id_artis'],
                  "nama_album"=>$_POST['nama_album'], 
                  "tanggal_rilis"=>$_POST['tanggal_rilis'],
                  "deskripsi"=>$_POST['deskripsi'],
                  "aksi"=>$_POST['aksi']);
    $album -> ubah_data($data);
    header('location:index.php?page=daftar-data');               
} else if ($_GET['aksi']=='hapus'){
    $album->hapus_data($_GET['id_album']);
    header('location:index.php?page=daftar-data');
}  
unset($album,$data);
?>
