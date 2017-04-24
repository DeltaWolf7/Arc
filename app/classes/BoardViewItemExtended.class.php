<?php

class BoardViewItemExtended extends DataProvider
{

    public $itemid;
    public $name;
    public $extended;
    public $display;

    public function __construct()
    {
        parent::__construct();
        $this->itemid = 0;
        $this->name = "";
        $this->extended = "";
        $this->display = 0;
        $this->table = "arcboard_itemsextended";
        $this->columns = ["id", "itemid", "name", "extended", "display"];
        $this->map = ["id" => "id", "itemid" => "itemid", "name" => "name",
                         "extended" => "extended", "display" => "display"];
    }
}