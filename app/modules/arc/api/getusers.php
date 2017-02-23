<?php

class getusersApi extends Api {

    public function __construct() {
        parent::__construct();
    }

    public function GET() {
        
        $users = User::getAllUsers();
        $users_json = array();

        foreach ($users as $user) {
            $usr = array();
            $usr["firstname"] = $user->firstname;
            $usr["lastname"] = $user->lastname;
            $usr["email"] = $user->email;
            $usr["enabled"] = $user->enabled;
            $usr["groups"] = $user->groups;
            $usr["companies"] = $user->company;
            $users_json[] = $usr;
        }
        
        system\Helper::arcReturnJSON(["message" => "OK", "Users" => $users_json]);
    }

}
