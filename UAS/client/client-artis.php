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
    public function tampil_semua_artis(){
        $client = curl_init($this->url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = simplexml_load_string($response);
        return $data;
        unset($data,$client,$response);
    }
    public function tampil_artis($id_artis){
        $id_artis = $this->filter($id_artis);
        $client = curl_init($this->url."?aksi=tampil&id_artis=".$id_artis);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $dataArtis = simplexml_load_string($response);
        return $dataArtis;
        unset($id_artis,$client,$response,$dataArtis);
    }
    public function tambah_artis($data){
        $data="<musikku>
                <artis>
                  <id_artis>".$data['id_artis']."</id_artis>
                  <nama_artis>".$data['nama_artis']."</nama_artis>
                  <genre_lagu>".$data['genre_lagu']."</genre_lagu>
                  <production>".$data['production']."</production>
                  <popularitas>".$data['popularitas']."</popularitas>
                  <aksi>".$data['aksi']."</aksi>
                </artis>
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
    public function ubah_artis($data){
        $data="<musikku>
                <artis>
                  <id_artis>".$data['id_artis']."</id_artis>
                  <nama_artis>".$data['nama_artis']."</nama_artis>
                  <genre_lagu>".$data['genre_lagu']."</genre_lagu>
                  <production>".$data['production']."</production>
                  <popularitas>".$data['popularitas']."</popularitas>
                  <aksi>".$data['aksi']."</aksi>
                </artis>
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
    public function hapus_artis($id_artis){
       $id_artis = $this->filter($id_artis);
       $data="<musikku>
                <artis>
                  <id_artis>".$id_artis."</id_artis>
                  <aksi>hapus</aksi>
                </artis>
               </musikku>";
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_artis,$data,$c,$response); 
    }
    public function __destruct(){
        unset($this->options,$this->api);
    }
}


$url = 'http://192.168.56.6/musikku/server/server-artis.php';
$abc = new Client($url);
?>