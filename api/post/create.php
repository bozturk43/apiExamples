<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Request-With');

 include_once '../../config/database.php';
 include_once '../../modals/post.php';

 //DB Sınıfından yeni birtane oluşturarak bağlantı açıldı
 $database=new database();
 $db=$database->connect();

 //post sıfınından yeni birtane oluşturularak bilgiler bu modelden alındı
 $post=new post($db);

 $data=json_decode(file_get_contents("php://input"));

 $post->baslik=$data->baslik;
 $post->icerik=$data->icerik;
 $post->yayinci=$data->yayinci;

 //Create post

 if($post->create()){
     echo json_encode(array('message'=>'İcerik yüklendi'));
 }

 else{
    echo json_encode(array('message'=>'İcerik yüklenmedi !'));
 }