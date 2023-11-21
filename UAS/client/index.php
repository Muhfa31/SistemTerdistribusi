<?php
error_reporting(1);
include "client-artis.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" 
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>RESTFUL TOKO</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Musikku</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarNav" aria-controls="navbarNav" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="?page=home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tambah Data
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="?page=tambahartis">Tabel Artis</a>
                    <a class="dropdown-item" href="?page=tambahlagu">Tabel Lagu</a>
                    <a class="dropdown-item" href="?page=tambahalbum">Tabel Album</a>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="?page=tambah">Tambah Data</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="?page=daftar-data">Daftar Data</a>
            </li>
            </ul>
        </div>
        </div>
  
    </nav>

    <!-- <fieldset> -->
        <?php if ($_GET['page'] == 'tambahartis') { ?>
            <div class="container col-md-6 mt-4">
                <h1>Tabel Artis</h1>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Tambah Artis
                    </div>
                <div class="card-body">
                    <form name="form" method="POST" action="proses_artis.php">
                        <input type="hidden" name="aksi" value="tambah" />
                        <div class="form-group">
                            <label>ID Artis</label>
                            <input type="text" name="id_artis" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Nama Artis</label>
                            <input type="text" name="nama_artis" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="genre_lagu" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Production</label>
                            <input type="text" name="production" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Popularitas</label>
                            <input type="text" name="popularitas" class="form-control"/>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </form>
                <?php } else if ($_GET['page'] == 'ubah') {
                    $r = $abc->tampil_artis($_GET['id_artis']);
                ?>
                </div>
            </div>
            <legend>Ubah Data</legend>
            <form name="form" method="POST" action="proses_artis.php">
                <input type="hidden" name="aksi" value="ubah" />
                <input type="hidden" name="id_artis" value="<?= $r->artis->id_artis?>" />
                <label>ID Artis</label>
                <input type="text" value="<?= $r->artis->id_artis?>" disabled>
                <br />
                <label>Nama Artis</label>
                <input type="text" name="nama_artis" value="<?= $r->artis->nama_artis?>">
                <br />
                <label>Genre</label>
                <input type="text" name="genre_lagu" value="<?= $r->artis->genre_lagu ?>">
                <br />
                <label>Production</label>
                <input type="text" name="production" value="<?= $r->artis->production?>">
                <br />
                <label>Popularitas</label>
                <input type="text" name="popularitas" value="<?= $r->artis->popularitas?>">
                <br />
                <button type="submit" name="ubah">Ubah</button>
            </form>

            <?php unset($r);
                } else if ($_GET['page'] == 'tambahlagu') {
            ?>
            <div class="container col-md-6 mt-4">
                <h1>Tabel Lagu</h1>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Tambah Lagu
                    </div>
                <div class="card-body">
                    <form name="form" method="POST" action="proses_lagu.php">
                        <input type="hidden" name="aksi" value="tambah" />
                        <div class="form-group">
                            <label>ID Lagu</label>
                            <input type="text" name="id_lagu" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>ID Artis</label>
                            <input type="text" name="id_artis" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>ID Album</label>
                            <input type="text" name="id_album" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Nama Lagu</label>
                            <input type="text" name="nama_lagu" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Tahun Rilis</label>
                            <input type="text" name="tahun_rilis" class="form-control"/>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </form>
                <?php } else if ($_GET['page'] == 'ubah') {
                    $r = $abc->tampil_data($_GET['id_lagu']);
                ?>
                </div>
            </div>
            <legend>Ubah Data</legend>
            <form name="form" method="POST" action="proses_lagu.php">
                <input type="hidden" name="aksi" value="ubah" />
                <input type="hidden" name="id_lagu" value="<?= $r->lagu->id_lagu?>" />
                <label>ID lagu</label>
                <input type="text" value="<?= $r->lagu->id_lagu?>" disabled>
                <br />
                <label>ID Artis</label>
                <input type="text" name="id_artis" value="<?= $r->lagu->id_artis?>">
                <br />
                <label>ID Album</label>
                <input type="text" name="id_album" value="<?= $r->lagu->id_album?>">
                <br />
                <label>Nama Lagu</label>
                <input type="text" name="nama_lagu" value="<?= $r->lagu->nama_lagu?>">
                <br />
                <label>Tahun Rilis</label>
                <input type="text" name="tahun_rilis" value="<?= $r->lagu->tahun_rilis?>">
                <br />
                <button type="submit" name="ubah">Ubah</button>
            </form>

            <?php unset($r);
                } else if ($_GET['page'] == 'tambahalbum') {
            ?>
            <div class="container col-md-6 mt-4">
                <h1>Tabel Album</h1>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Tambah Album
                    </div>
                <div class="card-body">
                    <form name="form" method="POST" action="proses_album.php">
                        <input type="hidden" name="aksi" value="tambah" />
                        <div class="form-group">
                            <label>ID Album</label>
                            <input type="text" name="id_album" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>ID Artis</label>
                            <input type="text" name="id_artis" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Nama Album</label>
                            <input type="text" name="nama_album" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Tanggal Rilis</label>
                            <input type="text" name="tanggal_rilis" class="form-control"/>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control"/>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </form>
                <?php } else if ($_GET['page'] == 'ubah') {
                    $r = $abc->tampil_data($_GET['id_album']);
                ?>
                </div>
            </div>
            <legend>Ubah Data</legend>
            <form name="form" method="POST" action="proses_album.php">
                <input type="hidden" name="aksi" value="ubah" />
                <input type="hidden" name="id_album" value="<?= $r->album->id_album?>" />
                <label>ID Album</label>
                <input type="text" value="<?= $r->album->id_album?>" disabled>
                <br />
                <label>ID Artis</label>
                <input type="text" name="id_artis" value="<?= $r->album->id_artis?>">
                <br />
                <label>Nama Album</label>
                <input type="text" name="nama_album" value="<?= $r->album->nama_album ?>">
                <br />
                <label>Tanggal Rilis</label>
                <input type="text" name="tanggal_rilis" value="<?= $r->album->tanggal_rilis?>">
                <br />
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" value="<?= $r->album->deskripsi?>">
                <br />
                <button type="submit" name="ubah">Ubah</button>
            </form>

        <?php unset($r);
        } else if ($_GET['page'] == 'daftar-data') {
        ?>
        <div class="container col-md-6 mt-4">
            <h2>Daftar Artis</h2>
            <div class="card">
                <div class="card-header bg-info text-white">
                    Artis
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Artis</th>
                                <th>Nama Artis</th>
                                <th>Genre Lagu</th>
                                <th>Production</th>
                                <th>Popularitas</th>
                                <th>Aksi</th>
                            </tr> 
                       </thead>
                        <tbody>
                            <?php $no = 1;
                            $data_array = $abc->tampil_semua_artis();
                            foreach ($data_array as $r) {
                            ?> <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $r->id_artis?></td>
                                    <td><?= $r->nama_artis?></td>
                                    <td><?= $r->genre_lagu?></td>
                                    <td><?= $r->production?></td>
                                    <td><?= $r->popularitas?></td>
                                    <td><a href="?page=ubah&id_artis=<?= $r->id_artis?>">Ubah</a></td>
                                    <td><a href="proses.php?aksi=hapus&id_artis=<?= $r->id_artis?>" onclick="return confirm('Apakah Anda Ingin Menghapus data ini?')">Hapus </a></td>
                                </tr>
                            <?php $no++;
                            }
                            unset($data_array, $r, $no);
                            ?>
                        </tbody>
                    </table>
        <?php } else { ?>
            <legend>Home</legend>
            Aplikasi sederhana ini menggunakan RESTful dengan format data XML (Extensible Markup Language). 
    <!-- </fieldset> -->
<?php } ?>
</body>

</html>