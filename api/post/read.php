<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/database.php';
 include_once '../../modals/post.php';

 //DB Sınıfından yeni birtane oluşturarak bağlantı açıldı
 $database=new database();
 $db=$database->connect();

 //post sıfınından yeni birtane oluşturularak bilgiler bu modelden alındı

 $post=new post($db);

 $result=$post->read();

 $num=$result->rowCount();

 if($num > 0){

    $post_arr=array();

    while($row=$result->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $post_item=array(
            'id'=>$id,
            'baslik'=>$baslik,
            'icerik'=>html_entity_decode($icerik),
            'resim'=>$resim,
            'yayinci'=>$yayinci,
            'yayin_tarihi'=>$yayin_tarihi
        );

        array_push($post_arr,$post_item);

    }

    echo json_encode($post_arr);


 }
 else
 {

    echo json_encode(
        array('message'=>'İçerik Yok')
    );

 }

