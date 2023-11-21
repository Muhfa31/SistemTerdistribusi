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
        $id_artis = $data->id_artis;
        $nama_artis = $data->nama_artis;
        $genre_lagu = $data->genre_lagu;
        $production = $data->production;
        $popularitas = $data->popularitas;
        $aksi = $data->aksi;
        if ($aksi == 'tambah')
        {
            $data2 = array('id_artis' => $id_artis, 
                            'nama_artis' => $nama_artis,
                            'genre_lagu' => $genre_lagu, 
                            'production' => $production,
                            'popularitas' => $popularitas,
                        );
        $abc->tambah_artis($data2); 
        } elseif ($aksi == 'ubah')
        {   $data2 = array('id_artis' => $id_artis, 
                            'nama_artis' => $nama_artis,
                            'genre_lagu' => $genre_lagu, 
                            'production' => $production,
                            'popularitas' => $popularitas,
                        );
            $abc->ubah_artis($data2);
        } elseif ($aksi == 'hapus')
        { $abc->hapus_artis($id_artis); 
        }

    unset($postdata, $data, $data2, $id_artis, $nama_artis, $genre_lagu, $production, $popularitas, $aksi, $abc);
    }   elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {   if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_artis']))) 
        {
            $id_artis = filter($_GET['id_artis']);
            $data = $abc->tampil_artis($id_artis);
            echo json_encode($data);
        } else 
        {   $data = $abc->tampil_semua_artis();
            echo json_encode($data);
        } 
        unset($postdata, $data, $id_artis, $abc);               
    }
?>