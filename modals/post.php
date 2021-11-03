<?php
class post{
    private $conn;
    private $table='services';

    public $id;
    public $baslik;
    public $icerik;
    public $yayinci;
    public $yayin_tarihi;

    public function __construct($db){

        $this->conn=$db;

    }

    public function read(){

        $query='SELECT id,baslik,icerik,yayinci,yayin_tarihi FROM '.$this->table.' ORDER BY yayin_tarihi DESC';

        //statement

        $stmt=$this->conn->prepare($query);

        //execute

        $stmt->execute();

        return $stmt;
    }
}