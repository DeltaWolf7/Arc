<?php

class ArcDownloadImage extends DataProvider {

    public $downloadid;
    public $image;

    public function __construct() {
        parent::__construct();;
        $this->downloadid = 0;
        $this->image = "";
        $this->table = ARCDBPREFIX . "download_images";
        $this->map = ["id" => "id", "downloadid" => "downloadid", "image" => "image"];
    }

    public static function getByID($id) {
        $image = new ArcDownloadImage();
        $image->get(["id" => $id, "LIMIT" => 1]);
        return $image;
    }
    
    public static function getAllByDownloadID($id) {
        $image = new ArcDownloadImage();
        return $image->getCollection(["downloadid" => $id]);
    }
}