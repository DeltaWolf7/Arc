<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $users = User::getAllUsers();
    $table = "<table class=\"table table-hover table-condensed\">";
    $table .= "<thead><tr><th>Name</th><th>Status</th><th>Email</th><th></th></tr></thead><tbody>";
    foreach ($users as $user) {
        $table .= "<tr><td>" . $user->getFullname() . "</td><td>";
        if ($user->enabled == true) {
            $table .= "<i class=\"fa fa-check\"></i>";
        } else {
            $table .= "<i class=\"fa fa-remove\"></i>";
        }
        $table .= "</td><td>" . $user->email . "</td><td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<a class=\"btn btn-success btn-xs\" onclick=\"editUser(" . $user->id . ")\"><i class=\"fa fa-pencil\"></i></a>"
                . "<a class=\"btn btn-danger btn-xs\" onclick=\"removeUser(" . $user->id . ")\"><i class=\"fa fa-remove\"></i></a>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}