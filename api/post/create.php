<?php
 header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Credentials: true");
 header('Content-Type: multipart/form-data');
 header('Content-Type: image/png');
 header('Access-Control-Allow-Headers:*');
 header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');

 include_once '../../config/database.php';
 include_once '../../modals/post.php';

 //DB Sınıfından yeni birtane oluşturarak bağlantı açıldı
 $database=new database();
 $db=$database->connect();

 //post sıfınından yeni birtane oluşturularak bilgiler bu modelden alındı
 $post=new post($db);



 $data=json_decode(file_get_contents("php://input"));

 if (isset($_FILES['file'])){

    $resim=$_FILES['file']['name'];
    $tmp_name=$_FILES['file']['tmp_name'];

    $baslik=$_POST['baslik'];
    $icerik=$_POST['icerik'];
    $yazar=$_POST['yazar'];

 
    echo $baslik;
    echo $icerik;
    echo $yazar;

    $post->baslik=$baslik;
    $post->icerik=$icerik;
    $post->yayinci=$yazar;
    $post->resim=$resim;
    
    $load_path="images/";
    move_uploaded_file($tmp_name,$load_path.$resim);
}
 
 

 //Create post
 
 
 if($post->create()){
     echo json_encode(array('message'=>'İcerik yüklendi',));
     
  
 }

 else{
    echo json_encode(array('message'=>'İcerik yüklenmedi !'));
    
}
