<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
    $table = "<table class=\"table table-hover table-condensed\">";
    $table .= "<thead><tr><th>Name</th><th>Status</th><th>Email</th><th></th></tr></thead><tbody>";
    foreach ($users as $user) {
        $table .= "<tr><td>" . $user->getFullname() . "</td><td>";
        if ($user->enabled == true) {
            $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
        } else {
            $table .= "<div class=\"label label-danger\"><i class=\"fa fa-remove\"></i></div>";
        }
        $table .= "</td><td>" . $user->email . "</td><td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<a class=\"btn btn-primary btn-xs\" onclick=\"impersonateUser(" . $user->id . ")\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Impersonate User\"><i class=\"fa fa-user-secret\"></i></a>"
                . "<a class=\"btn btn-success btn-xs\" onclick=\"editUser(" . $user->id . ")\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Edit User\"><i class=\"fa fa-pencil\"></i></a>"
                . "<a class=\"btn btn-danger btn-xs\" onclick=\"removeUser(" . $user->id . ")\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Delete User\"><i class=\"fa fa-remove\"></i></a>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}