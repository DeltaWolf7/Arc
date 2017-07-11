<?php

class rewarduser extends Api {

    public function __construct() {
        parent::__construct();
    }

    public function POST() {
        
        // do something here
        
        system\Helper::arcReturnJSON(["message" => "OK"]);
    }

}
