<?php
    error_reporting(1);
    include "Database.php";
    $abc = new Database();

    if(isset($_SERVER['HTTP_ORIGIN'])){
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Acess-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }
    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Acess-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']})");
        exit(0);
    }
    $postdata = file_get_contents("php://input");

    function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data; 
        unset($data);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    { 
        $data = json_decode($postdata);
        $id_album = $data->id_album;
        $id_artis = $data->id_artis;
        $nama_album = $data->nama_album;
        $tanggal_rilis = $data->tanggal_rilis;
        $deskripsi = $data->deskripsi;
        $aksi = $data->aksi;
        if ($aksi == 'tambah')
        {
            $data2 = array('id_album' => $id_album, 
                            'id_artis' => $id_artis,
                            'nama_album' => $nama_album, 
                            'tanggal_rilis' => $tanggal_rilis,
                            'deskripsi' => $deskripsi,
                        );
        $abc->tambah_album($data2); 
        } elseif ($aksi == 'ubah')
        {   $data2 = array('id_album' => $id_album, 
                            'id_artis' => $id_artis,
                            'nama_album' => $nama_album, 
                            'tanggal_rilis' => $tanggal_rilis,
                            'deskripsi' => $deskripsi,
                        );
            $abc->ubah_album($data2);
        } elseif ($aksi == 'hapus')
        { $abc->hapus_album($id_album); 
        }

    unset($postdata, $data, $data2, $id_album, $id_artis, $nama_album, $tanggal_rilis, $deskripsi, $aksi, $abc);
    }   elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {   if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_album']))) 
        {
            $id_album = filter($_GET['id_album']);
            $data = $abc->tampil_album($id_album);
            echo json_encode($data);
        } else 
        {   $data = $abc->tampil_semua_album();
            echo json_encode($data);
        } 
        unset($postdata, $data, $id_album, $abc);
    }
?>