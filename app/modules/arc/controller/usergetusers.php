<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = [];
    
    if (!isset($_POST["search"]) || $_POST["search"] == "") {
        $users = User::getAllUsers();
    } else {
        $users = User::search($_POST["search"]);
    }

    $table = "<div class=\"mb-2 row\">"
        . "<div class=\"col-md-8\">"
            . "<div class=\"input-group mb-3\">"
                . "<input class=\"form-control\" id=\"search\" placeholder=\"Search..\" aria-describedby=\"basic-addon2\" />"
                . "<div class=\"input-group-append\">"
                  . "<button class=\"btn btn-outline-secondary\" type=\"button\" onclick=\"searchUsers()\"><i class=\"fas fa-search\"></i></button>"
                . "</div>"
            . "</div>"
        . "</div>"
        . "<div class=\"col-md-4 mt-1 text-right\"><a href=\"#\" class=\"btn btn-secondary btn-sm\" onclick=\"exportUsers()\"><i class=\"fas fa-download\"></i></a>"
        . "&nbsp<a href=\"#\" class=\"btn btn-secondary btn-sm\" onclick=\"displayUsers()\"><i class=\"fas fa-table\"></i></a>"
        . "&nbsp;<a href=\"#\" class=\"btn btn-primary btn-sm\" onclick=\"viewGroups()\"><i class=\"fas fa-list\"></i> Groups</a>"
        . "&nbsp;<a href=\"#\" class=\"btn btn-success btn-sm\" onclick=\"editUser(0)\"><i class=\"fas fa-plus\"></i> New User</a></div>"
        . "</div>";
    $table .= "<table class=\"table table-striped\">";
    $table .= "<thead><th>#</th><th>Name (" . count($users) . ")</th><th>Active</th><th>Email</th><th>CRM</th><th>Auth</th><th>Action</th></tr></thead><tbody>";
    foreach ($users as $user) {
        $crmuser = CRMUser::getByUserID($user->id);
        $table .= "<tr><td class=\"text-center\">" . $user->id . "</td><td>";
        $isAdmin = $user->inGroup("Administrators");
        if ($isAdmin == true) {
            $table .= "<i class=\"fas fa-user-shield text-danger\"></i> ";
        }
        $table .= "<a href=\"#\" onclick=\"editUser(" . $user->id . ")\">" . $user->getFullname() . "</a></td><td class=\"text-center\">";
        if ($user->enabled == true) {
            $table .= "<button class=\"btn btn-success btn-sm\" onclick=\"toggleEnable(" . $user->id . ")\"><i class=\"fa fa-check\"></i></button>";
        } else {
            $table .= "<button class=\"btn btn-danger btn-sm\" onclick=\"toggleEnable(" . $user->id . ")\"><i class=\"fa fa-remove\"></i></button>";
        }
        $table .= "</td><td>" . $user->email . "</td>"
                . "<td class=\"text-center\">";
        if ($crmuser->id == 1) {
            $table .= "<i class=\"fas fa-check text-success\"></i>";
        } else {
            $table .= "<i class=\"fas fa-times text-danger\"></i>";
        }
        $table .= "</td><td class=\"text-center\">";

        $ad = SystemSetting::getByKey("ARC_USER_AD", $user->id);
        if ($ad->id == 0) {
            $table .= "<i class=\"fa fa-user\"></i>";
        } else {
            $table .= "<i class=\"fa fa-cloud-download\"></i>";
        }
       
        $table .= "</td>"
                . "<td style=\"width: 10px;\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<button class=\"btn btn-secondary btn-sm\" onclick=\"impersonateUser(" . $user->id . ")\"><i class=\"fas fa-user-secret\"></i></button>"
                . "<button class=\"btn btn-primary btn-sm\" onclick=\"editUser(" . $user->id . ")\"><i class=\"fa fa-pencil\"></i></button>"
                . "<button style=\"width: 35px;\" class=\"btn btn-danger btn-sm\" onclick=\"removeUser(" . $user->id . ")\"><i class=\"fa fa-remove\"></i></button>"
                . "</div>"
                . "</td></tr>";
        
    }
    $table .= "</table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}