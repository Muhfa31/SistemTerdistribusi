<?php
error_reporting(1);

class Client{
    private $url;

    public function __construct($url){
        $this->url=$url;
        unset($url);
    }
    public function filter($data){
        $data = preg_replace('/[^a-zA-Z0-9]/','',$data);
        return $data;
        unset($data);
    }
    public function tampil_semua_data(){
        $client = curl_init($this->url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = simplexml_load_string($response);
        return $data;
        unset($data,$client,$response);
    }
    public function tampil_data($id_lagu){
        $id_lagu = $this->filter($id_lagu);
        $client = curl_init($this->url."?aksi=tampil&id_lagu=".$id_lagu);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = simplexml_load_string($response);
        return $data;
        unset($id_lagu,$client,$response,$data);
    }
    public function tambah_data($data){
        $data="<musikku>
                <lagu>
                  <id_lagu>".$data['id_lagu']."</id_lagu>
                  <id_artis>".$data['id_artis']."</id_artis>
                  <id_album>".$data['id_album']."</id_album>
                  <nama_lagu>".$data['nama_lagu']."</nama_lagu>
                  <tahun_rilis>".$data['tahun_rilis']."</tahun_rilis>
                  <aksi>".$data['aksi']."</aksi>
                </lagu>
               </musikku>";
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response);       
    }
    public function ubah_data($data){
        $data="<musikku>
                <lagu>
                  <id_lagu>".$data['id_lagu']."</id_lagu>
                  <id_artis>".$data['id_artis']."</id_artis>
                  <id_album>".$data['id_album']."</id_album>
                  <nama_lagu>".$data['nama_lagu']."</nama_lagu>
                  <tahun_rilis>".$data['tahun_rilis']."</tahun_rilis>
                  <aksi>".$data['aksi']."</aksi>
                </lagu>
               </musikku>";
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response); 
    }
    public function hapus_data($id_lagu){
       $id_lagu = $this->filter($id_lagu);
       $data="<musikku>
                <lagu>
                  <id_lagu>".$id_lagu."</id_lagu>
                  <aksi>hapus</aksi>
                </lagu>
               </musikku>";
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_lagu,$data,$c,$response); 
    }
    public function __destruct(){
        unset($this->options,$this->api);
    }
}

$url = 'http://192.168.56.6/musikku/server/server.php';
$abc = new Client($url);
?>