<?php

class BoardViewItem extends DataProvider
{

    public $image;
    public $title;
    public $subtitle;
    public $description;
    public $links;
    public $lifespan;
    public $extended;
    public $created;
    public $expired;

    public function __construct()
    {
        parent::__construct();
        $this->image = "";
        $this->title = "";
        $this->subtitle = "";
        $this->description = "";
        $this->links = "";
        $this->lifespan = -1;
        $this->extended = "";
        $this->created = new DateTime("NOW");
        $this->expired = false;
        $this->table = "arcboard_items";
        $this->columns = ["id", "image", "title", "subtitle", "description", "links", "lifespan", "extended",
                            "created", "expired"];
        $this->map = ["id" => "id", "image" => "image", "title" => "title", "subtitle" => "subtitle",
                        "description" => "description", "links" => "links", "lifespan" => "lifespan",
                        "extended" => "extended", "created" => "created", "expired" => "expired"];
    }

    public static function getByID($id)
    {
        $item = new BoardViewItem();
        $item->get(["id" => $id]);
        return $item;
    }

    public static function getItems($expired = false)
    {
        $items = new BoardViewItem();
        return $items->getCollection(["expired" => $expired]);
    }

    public function getLifespan()
    {
        if ($this->lifespan != -1) {
            $datetimeNow = new DateTime("NOW");
            $datetimeLife = new DateTime($this->created);
            date_add($datetimeLife, date_interval_create_from_date_string($this->lifespan . ' seconds'));
            return $datetimeLife->getTimestamp() - $datetimeNow->getTimestamp();
        }
        return -1;
    }

    public static function checkLifespans()
    {
        $items = new BoardViewItem();
        $data = $items->getCollection(["expired" => false]);
        foreach ($data as $item) {
            if ($item->lifespan != -1) {
                $datetimeNow = new DateTime("NOW");
                $datetimeLife = new DateTime($item->created);
                date_add($datetimeLife, date_interval_create_from_date_string($item->lifespan . ' seconds'));
                if ($datetimeNow > $datetimeLife) {
                    // item has expired
                    $item->expired = true;
                    $item->update();
                }
            }
        }
    }
}
