<?php

class ServiceManagerItem extends DataProvider {
    
    public $data;
    
    public function __construct() {
        parent::__construct();
        $this->data = "{}";
        $this->table = "sm_items";
        $this->columns = ["id", "data"];
    }
    
    public static function getAll() {
        $items = new ServiceManagerItem();
        return $items->getCollection([]);
    }
    
}

