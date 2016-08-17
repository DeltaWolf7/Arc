<?php


class ArcRecGuest extends DataProvider {
    
    public $name;
    public $email;
    public $image;
    public $company;
    public $phone;
    public $title;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->email = "";
        $this->image = "";
        $this->company = "";
        $this->phone = "";
        $this->title = "";
        $this->table = "arcrec_guests";
        $this->map = ["id" => "id", "name" => "name", "image" => "image", "company" => "company",
            "phone" => "phone", "title" => "title"];
        $this->columns = ["id", "name", "email", "image", "company", "phone", "title"];
    }
    
    public static function getByID($id) {
        $guest = new ArcRecGuest();
        $guest->get(["id" => $id]);
        return $guest;
    }
}
