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
        $id_lagu = $data->id_lagu;
        $id_artis = $data->id_artis;
        $id_album = $data->id_album;
        $nama_lagu = $data->nama_lagu;
        $tahun_rilis = $data->tahun_rilis;
        $aksi = $data->aksi;
        if ($aksi == 'tambah')
        {
            $data2 = array('id_lagu' => $id_lagu, 
                            'id_artis' => $id_artis,
                            'id_album' => $id_album, 
                            'nama_lagu' => $nama_lagu,
                            'tahun_rilis' => $tahun_rilis,
                        );
        $abc->tambah_lagu($data2); 
        } elseif ($aksi == 'ubah')
        {   $data2 = array('id_lagu' => $id_lagu, 
                            'id_artis' => $id_artis,
                            'id_album' => $id_album, 
                            'nama_lagu' => $nama_lagu,
                            'tahun_rilis' => $tahun_rilis,
                        );
            $abc->ubah_lagu($data2);
        } elseif ($aksi == 'hapus')
        { $abc->hapus_lagu($id_lagu); 
        }

    unset($postdata, $data, $data2, $id_lagu, $id_artis, $id_album, $nama_lagu, $tahun_rilis, $aksi, $abc);
    }   elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {   if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_lagu']))) 
        {
            $id_lagu = filter($_GET['id_lagu']);
            $data = $abc->tampil_lagu($id_lagu);
            echo json_encode($data);
        } else 
        {   $data = $abc->tampil_semua_lagu();
            echo json_encode($data);
        } 
        unset($postdata, $data, $id_lagu, $abc);               
    }
?>