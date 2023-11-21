<?php
error_reporting(1); //error ditampilkan

class Database
{   private $host="192.168.56.6";
    private $dbname="musikku";
    private $user="faza";
    private $password="faza";
    private $port="3306";
    private $conn;

    //function yang pertama kali di-load saat class dipanggil
    public function __construct()
    { //koneksi database
        try
        { $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8",$this->user,$this->password);
        
        } catch (PDOException $e)
        {    echo "Koneksi Tidak Berhasil";
        }  
    }

    public function tampil_semua_artis()
    {   
        $query = $this->conn->prepare("select id_artis, nama_artis, genre_lagu, production, popularitas from artis order by id_artis");
        $query->execute();
        //mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //mengembalikan data
        return $data;
        $query->closeCursor();
        unset($data);
     }

    public function tampil_semua_album()
    {   $query = $this->conn->prepare("select id_album, id_artis, nama_album, tanggal_rilis, deskripsi from album order by id_album");
        $query->execute();
        //mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //mengembalikan data
        return $data;
        $query->closeCursor();
        unset($data);
     }

    public function tampil_semua_lagu()
    {   $query = $this->conn->prepare("select id_lagu, id_artis, id_album, nama_lagu, tahun_rilis from lagu order by id_lagu");
        $query->execute();
        //mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        //mengembalikan data
        return $data;
        $query->closeCursor();
        unset($data);
     }

    //  FUNGSI UNTUK TAMPIL
    public function tampil_artis($id_artis)
    {  $query = $this->conn->prepare("select artis.id_artis, nama_lagu.id_lagu, artis.nama_artis, artis.genre_lagu, artis.production FROM artis JOIN lagu ON lagu.id_artis = artis.id_artis where id_artis=?");
       $query->execute(array($id_artis));
       //mengambil satu data dengan fetch
       $data = $query->fetch(PDO::FETCH_ASSOC);
       //mengembalikan data
       return $data;
       //hapus variable dari memory
       $query->closeCursor();
       unset($id_artis,$data);
    }

    public function tampil_pelanggan($id_pelanggan)
    {  $query = $this->conn->prepare("select pelanggan.id_pelanggan, hp.id_hp, pelanggan.nik,pelanggan.nama, pelanggan.alamat, pelanggan.no_hp FROM pelanggan JOIN hp ON pelanggan.id_hp = hp.id_hp where id_pelanggan=?");
       $query->execute(array($id_pelanggan));
       //mengambil satu data dengan fetch
       $data = $query->fetch(PDO::FETCH_ASSOC);
       //mengembalikan data
       return $data;
       //hapus variable dari memory
       $query->closeCursor();
       unset($id_pelanggan, $data);
    }

    public function tampil_spesifikasi($id_spesifikasi)
    {  $query = $this->conn->prepare("select id_spesifikasi, ram_rom, os, baterai, resolusi, kamera, jaringan FROM spesifikasi WHERE id_spesifikasi=?");
       $query->execute(array($id_spesifikasi));
       //mengambil satu data dengan fetch
       $data = $query->fetch(PDO::FETCH_ASSOC);
       //mengembalikan data
       return $data;
       //hapus variable dari memory
       $query->closeCursor();
       unset($id_spesifikasi,$data);
    }

    public function tampil_transaksi($id_transaksi)
    {  $query = $this->conn->prepare("select transaksi.id_transaksi, pelanggan.id_pelanggan, transaksi.tanggal, transaksi.jumlah FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan where id_transaksi=?");
      // $query = $this->conn->prepare("select hp.id_hp, spesifikasi.id_spesifikasi, hp.namahp, hp.merek, hp.harga FROM hp JOIN spesifikasi ON hp.id_spesifikasi = spesifikasi.id_spesifikasi where id_hp=?");
       $query->execute(array($id_transaksi));
       //mengambil satu data dengan fetch
       $data = $query->fetch(PDO::FETCH_ASSOC);
       //mengembalikan data
       return $data;
       //hapus variable dari memory
       $query->closeCursor();
       unset($id_transaksi,$data);
    }


    // FUNGSI UNTUK TAMBAH DATA PADA TABEL 
     public function tambah_artis($data)
     {   $query = $this->conn->prepare("insert ignore into artis (id_artis, nama_artis, genre_lagu, production, popularitas) values (?,?,?,?,?)");
         $query->execute(array($data['id_artis'], $data['nama_artis'], $data['genre_lagu'], $data['production'], $data['popularitas']));
         $query->closeCursor();
         unset($data);
      }
      
     public function tambah_pelanggan($data)
     {   $query = $this->conn->prepare("insert ignore into pelanggan (id_pelanggan, id_hp, nik, nama, alamat, no_hp) values (?,?,?,?,?,?)");
         $query->execute(array($data['id_pelanggan'], $data['id_hp'], $data['nik'], $data['nama'], $data['alamat'], $data['no_hp']));
         $query->closeCursor();
         unset($data);
      }

     public function tambah_spesifikasi($data)
     {   $query = $this->conn->prepare("insert ignore into spesifikasi (id_spesifikasi, ram_rom, os, baterai, resolusi, kamera, jaringan) values (?,?,?,?,?,?,?)");
         $query->execute(array($data['id_spesifikasi'],$data['ram_rom'],$data['os'],$data['baterai'],$data['resolusi'],$data['kamera'],$data['jaringan']));
         $query->closeCursor();
         unset($data);
      }

     public function tambah_transaksi($data)
     {   $query = $this->conn->prepare("insert ignore into transaksi (id_transaksi, id_pelanggan, tanggal, jumlah) values (?,?,?,?)");
         $query->execute(array($data['id_transaksi'], $data['id_pelanggan'], $data['tanggal'], $data['jumlah']));
         $query->closeCursor();
         unset($data);
      }


    // FUNGSI UNTUK UBAH DATA PADA TABEL
      public function ubah_hp($data)
     {   $query = $this->conn->prepare("update hp set id_spesifikasi=?, namahp=?, merek=?, harga=?  where id_hp=?");
         $query->execute(array($data['id_spesifikasi'], $data['namahp'], $data['merek'], $data['harga'], $data['id_hp']));
         $query->closeCursor();
         unset($data);
      }

      public function ubah_pelanggan($data)
     {   $query = $this->conn->prepare("update pelanggan set id_hp=?, nik=?, nama=?, alamat=?, no_hp=? where id_pelanggan=?");
         $query->execute(array($data['id_hp'], $data['nik'], $data['nama'], $data['alamat'], $data['no_hp'], $data['id_pelanggan']));
         $query->closeCursor();
         unset($data);
      }

      public function ubah_spesifikasi($data)
     {   $query = $this->conn->prepare("update spesifikasi set ram_rom=?, os=?, baterai=?, resolusi=?, kamera=?, jaringan=? where id_spesifikasi=?");
         $query->execute(array($data['ram_rom'], $data['os'], $data['baterai'], $data['resolusi'], $data['kamera'], $data['jaringan'], $data['id_spesifikasi']));
         $query->closeCursor();
         unset($data);
      }

      public function ubah_transaksi($data)
     {   $query = $this->conn->prepare("update transaksi set id_pelanggan=?, tanggal=?, jumlah=? where id_transaksi=?");
         $query->execute(array($data['id_pelanggan'], $data['tanggal'], $data['jumlah'], $data['id_transaksi']));
         $query->closeCursor();
         unset($data);
      }

    //   FUNGSI UNTUK HAPUS DATA PADA TABEL
      public function hapus_hp($id_hp)
     {   $query = $this->conn->prepare("delete from hp where id_hp=?");
         $query->execute(array($id_hp));
         $query->closeCursor();
         unset($id_hp);
      }

      public function hapus_pelanggan($id_pelanggan)
     {   $query = $this->conn->prepare("delete from pelanggan where id_pelanggan=?");
         $query->execute(array($id_pelanggan));
         $query->closeCursor();
         unset($id_pelanggan);
      }

      public function hapus_spesifikasi($id_spesifikasi)
     {   $query = $this->conn->prepare("delete from spesifikasi where id_spesifikasi=?");
         $query->execute(array($id_spesifikasi));
         $query->closeCursor();
         unset($id_spesifikasi);
      }

      public function hapus_transaksi($id_transaksi)
     {   $query = $this->conn->prepare("delete from transaksi where id_transaksi=?");
         $query->execute(array($id_transaksi));
         $query->closeCursor();
         unset($id_transaksi);
      }
}
?>