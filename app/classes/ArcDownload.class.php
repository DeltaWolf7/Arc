<?php

class ArcDownload extends DataProvider {

    public $date;
    public $title;
    public $description;
    public $version;
    public $file;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d H:i:s");
        $this->title = "";
        $this->description = "";
        $this->version = "";
        $this->file = "";
        $this->table = ARCDBPREFIX . "downloads";
        $this->map = ["id" => "id", "date" => "date", "title" => "title", "description" => "description",
             "version" => "version", "file" => "file"];
    }

    public static function getByID($id) {
        $download = new ArcDownload();
        $download->get(["id" => $id, "LIMIT" => 1]);
        return $download;
    }

    public static function getAllByDownloads() {
        $download = new ArcDownload();
        return $download->getCollection([]);
    }
}