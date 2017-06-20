<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
    $table = "<table class=\"table table-hover table-sm\">";
    $table .= "<thead><tr><th>Name</th><th>Status</th><th>Email</th><th>Auth</th><th></th></tr></thead><tbody>";
    foreach ($users as $user) {
        $table .= "<tr><td>" . $user->getFullname() . "</td><td>";
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
                . "<td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<button class=\"btn btn-success btn-sm\" onclick=\"editUser(" . $user->id . ")\"><i class=\"fa fa-pencil\"></i> Edit</button>"
                . "<button class=\"btn btn-danger btn-sm\" onclick=\"removeUser(" . $user->id . ")\"><i class=\"fa fa-remove\"></i> Remove</button>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}