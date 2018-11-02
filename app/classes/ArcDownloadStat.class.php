<?php

class ArcDownloadStat extends DataProvider {

    public $downloadid;
    public $browser;
    public $ip;
    public $datetime;

    public function __construct() {
        parent::__construct();
        $this->datetime = date("y-m-d H:i:s");
        $this->ip = "";
        $this->browser = "";
        $this->downloadid = 0;
        $this->table = ARCDBPREFIX . "download_stats";
        $this->map = ["id" => "id", "downloadid" => "downloadid", "browser" => "browser", "ip" => "ip",
             "datetime" => "datetime"];
    }

    public static function getByID($id) {
        $download = new ArcDownloadStat();
        $download->get(["id" => $id]);
        return $download;
    }

    public static function getAllByDownloadID($id) {
        $image = new ArcDownloadStat();
        return $image->getCollection(["downloadid" => $id]);
    }
}