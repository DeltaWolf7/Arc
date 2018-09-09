<?php

class getdownloadApi extends Api {

    public function __construct() {
        parent::__construct();
    }

    public function GET() {
             
        
        system\Helper::arcReturnJSON(["message" => "OK", "result" => "Download here.."]);
    }

}
