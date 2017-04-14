<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
    $table = "<table class=\"table table-hover table-condensed\">";
    $table .= "<thead><tr><th>Name</th><th>Status</th><th>Email</th><th>Auth</th><th></th></tr></thead><tbody>";
    foreach ($users as $user) {
        $table .= "<tr><td>" . $user->getFullname() . "</td><td>";
        if ($user->enabled == true) {
            $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i> Enabled</div>";
        } else {
            $table .= "<div class=\"label label-danger\"><i class=\"fa fa-remove\"></i> Disabled</div>";
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
                . "<a class=\"btn btn-primary btn-xs\" onclick=\"impersonateUser(" . $user->id . ")\"><i class=\"fa fa-user-secret\"></i> Impersonate</a>"
                . "<a class=\"btn btn-success btn-xs\" onclick=\"editUser(" . $user->id . ")\"><i class=\"fa fa-pencil\"></i> Edit</a>"
                . "<a class=\"btn btn-danger btn-xs\" onclick=\"removeUser(" . $user->id . ")\"><i class=\"fa fa-remove\"></i> Remove</a>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}