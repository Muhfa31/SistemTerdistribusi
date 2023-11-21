<?php
include "client-artis.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <a href="?page=home">Home</a> | <a href="?page=tambah">Tambah Data</a> | <a href="?page=daftar-data">Data Server</a>
    <br/><br/>

    <fieldset>
        <?php  if ($_GET['page']=='tambah') { ?>
            <legend>Tambah Data</legend>
            <form name="form" method="POST" action="proses.php">
                <input type="hidden" name="aksi" value="tambah"/>
                <label>ID Barang</label>
                <input type="text" name="id_artis"/>
                <br/>
                <label>Nama Barang</label>
                <input type="text" name="nama_artis"/>
                <br/>
                <label>Stok Barang</label>
                <input type="text" name="genre_lagu"/>
                <br/>
                <label>Harga Satuan</label>
                <input type="text" name="production"/>
                <br/>
                <button type="submit" name="simpan">Simpan</button>
            </form>

            <?php  } elseif ($_GET['page']=='ubah'){
                $r = $abc->tampil_artis($_GET['id_artis']);
                ?>
            <legend>Ubah Data</legend>
            <form name="form" method="post" action="proses_artis.php">
                <input type="hidden" name="aksi" value="ubah"/>
                <input type="hidden" name="id_artis" value="<?=$r->id_artis?>"/>
                <label>ID Barang</label>
                <input type="text" value="<?=$r->id_artis?>" disabled>
                <br/>
                <label>Nama Barang</label>
                <input type="text" name="nama_artis" value="<?=$r->nama_artis?>">
                <br/>
                <label>Stok Barang</label>
                <input type="text" name="genre_lagu" value="<?=$r->genre_lagu?>">
                <br/>
                <label>Production</label>
                <input type="text" name="production" value="<?=$r->production?>">
                <br/>
                <label>Popularitas</label>
                <input type="text" name="popularitas" value="<?=$r->popularitas?>">
                <br/>
                <button type="submit" name="ubah">Ubah</button>
            </form>

            <?php  unset($r);
            } else if ($_GET['page']=='daftar-data') {
            ?>
            <legend>Daftar Data Server</legend>
            <table border="1">
                <tr><th Width='5%'>No</th>
                <th Width='10%'>ID Barang</th>
                <th Width='30%'>Nama</th>
                <th Width='30%'>Genre Lagu</th>
                <th Width='30%'>Production</th>
                <th Width='30%'>Popularitas</th>
                <th Width='5%' colspan="2">Aksi</th>
            </tr>
            <?php  $no = 1;
               $data_array = $abc->tampil_semua_artis();
               foreach ($data_array as $r){
                ?> <tr><td><?=$no?></td>
                    <td><?=$r->id_artis?></td>
                    <td><?=$r->nama_artis?></td>
                    <td><?=$r->genre_lagu?></td>
                    <td><?=$r->production?></td>
                    <td><?=$r->popularitas?></td>
                    <td><a href="?page=ubah&id_artis=<?=$r->id_artis?>">Ubah</a></td>
                    <td><a href="proses_artis.php?aksi=hapus&id_artis=<?=$r->id_artis?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Hapus</a></td>
                </tr>
                <?php  $no++;
                    }
                    unset($data_array,$r,$no);
                    ?>
            </table>
            
            <?php  } else { ?>
                <legend>Home</legend>
                    Aplikasi sederhana ini menggunakan RESTful dengan format data XML (Extensible Markup Language). 
    </fieldset>
    <?php  } ?>
</body>
</html>