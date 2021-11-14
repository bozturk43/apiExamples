<?php
class post{
    private $conn;
    private $table='services';

    public $id;
    public $baslik;
    public $icerik;
    public $image;
    public $yayinci;
    public $yayin_tarihi;

    public function __construct($db){

        $this->conn=$db;

    }

    //read posts
    public function read(){

        $query='SELECT id,baslik,icerik,resim,yayinci,yayin_tarihi FROM '.$this->table.' ORDER BY yayin_tarihi DESC';

        //statement

        $stmt=$this->conn->prepare($query);

        //execute

        $stmt->execute();

        return $stmt;
    }
   //create posts
   
   public function create(){


       $query='INSERT INTO services SET baslik= :baslik, icerik= :icerik, yayinci= :yayinci,resim= :resim';

       //statement hazırla

       $stmt=$this->conn->prepare($query);       

        //data binding

        $stmt->bindParam(':baslik',$this->baslik);
        $stmt->bindParam(':icerik',$this->icerik);
        $stmt->bindParam(':yayinci',$this->yayinci);
        $stmt->bindParam(':resim',$this->resim);
     
       

        //query çalıştır

        if($stmt->execute()){
            return true;
        }

        //error yazdır
        printf("Error:%s.\n",$stmt->error);
        return false;

   }
}