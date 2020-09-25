<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = [];
    
    if (!isset($_POST["search"]) || $_POST["search"] == "") {
        $users = User::getAllUsers();
    } else {
        $users = User::search($_POST["search"]);
    }


    $table = "<div class=\"mb-2 row\">"
        . "<div class=\"col-md-1 mt-2\">Search</div>"
        . "<div class=\"col-md-7\">"
            . "<div class=\"input-group mb-3\">"
                . "<input class=\"form-control\" id=\"search\" placeholder=\"Search..\" aria-describedby=\"basic-addon2\" />"
                . "<div class=\"input-group-append\">"
                  . "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"searchUsers()\"><i class=\"fas fa-search\"></i></button>"
                . "</div>"
            . "</div>"
        . "</div>"
        . "<div class=\"col-md-2 mt-1\"><a href=\"#\" class=\"btn btn-primary btn-sm btn-block\" onclick=\"viewGroups()\"><i class=\"fas fa-list\"></i> View Groups</a></div>"
        . "<div class=\"col-md-2 mt-1\"><a href=\"#\" class=\"btn btn-primary btn-sm btn-block\" onclick=\"editUser(0)\"><i class=\"fas fa-plus\"></i> New User</a></div>"
        . "</div>";
    $table .= "<table class=\"table table-striped\">";
    $table .= "<thead><tr><th>#</th><th>Name</th><th>Status</th><th>Email</th><th>Auth</th><th>Action</th></tr></thead><tbody>";
    foreach ($users as $user) {
        $table .= "<tr><td>" . $user->id . "</td><td><a href=\"#\" onclick=\"editUser(" . $user->id . ")\">" . $user->getFullname() . "</a></td><td>";
        if ($user->enabled == true) {
            $table .= "<div class=\"badge badge-success\"><i class=\"fa fa-check\"></i> Enabled</div>";
        } else {
            $table .= "<div class=\"badge badge-danger\"><i class=\"fa fa-remove\"></i> Disabled</div>";
        }
        $table .= "</td><td>" . $user->email . "</td>"
                . "<td>";
        
        $ad = SystemSetting::getByKey("ARC_USER_AD", $user->id);
        if ($ad->id == 0) {
            $table .= "<i class=\"fa fa-user\"></i> Local";
        } else {
            $table .= "<i class=\"fa fa-cloud-download\"></i> LDAP";
        }
        
        $table .= "</td>"
                . "<td style=\"width: 10px;\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<button class=\"btn btn-primary btn-sm\" onclick=\"editUser(" . $user->id . ")\"><i class=\"fa fa-pencil\"></i></button>"
                . "<button style=\"width: 35px;\" class=\"btn btn-danger btn-sm\" onclick=\"removeUser(" . $user->id . ")\"><i class=\"fa fa-remove\"></i></button>"
                . "</div>"
                . "</td></tr>";
        
    }
    $table .= "</table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}