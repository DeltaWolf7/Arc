<?php

class queryApi extends Api {

    public function __construct() {
        parent::__construct();
    }

    public function GET() {
        $domains = explode(',', $_GET["domains"]);
        $domain_json = array();

        foreach ($domains  as $domain) {
            $dom = array();
            $whois = new Whois();
            $data = $whois->getWhois($domain);
            $dom["domain"] = $data['Domain'];
            $dom["expire"] = $data['Expire'];
            $dom["days"] = $data['Days'];
            $domain_json[] = $dom;
        }
        
        system\Helper::arcReturnJSON(["message" => "OK", "Results" => $domain_json]);
    }

}