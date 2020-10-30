<?php

class ArcEcomImage extends DataProvider {

    public $imagetype;
    public $filename;
    public $sortorder;
    public $productid;

    public function __construct() {
        parent::__construct();
        $this->imagetype = "";
        $this->filename = "";
        $this->sortorder = 0;
        $this->productid = 0;
        $this->table = ARCDBPREFIX . "ecom_images";
        $this->map = ["id" => "id", "imagetype" => "imagetype", "filename" => "filename", "sortorder" => "sortorder", "productid" => "productid"];
    }

    public static function getByID($id) {
        $image = new ArcEcomImage();
        $image->get(["id" => $id]);
        return $image;
    }

    public static function getByProductIDAndType($productid, $type) {
        $image = new ArcEcomImage();
        $image->get(["imagetype" => $type, "productid" => $productid]);
        return $image;
    }

    public static function getAll() {
        $images = new ArcEcomImage();
        return $images->getCollection([]);
    }

    public static function getAllByProductIDAndType($productid, $type) {
        $images = new ArcEcomImage();
        return $images->getCollection(["imagetype" => $type, "productid" => $productid, "ORDER" => "sortorder"]);
    }
}