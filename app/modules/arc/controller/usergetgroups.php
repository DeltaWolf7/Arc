<?php

if (system\Helper::arcIsAjaxRequest()) {
    $table = "<div class=\"text-right mb-2\">"
        . "<button onclick=\"editGroup(0);\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-plus\"></i> Create Group</button>&nbsp;"    
        . "<button class=\"btn btn-primary btn-sm\" onclick=\"closeUser()\"><i class=\"fas fa-list\"></i> View Users</button></div>";
    $table .= "<div class=\"table-responsive\"><table class=\"table table-striped\">"
            . "<thead><tr><th>Name</th><th>Description</th><th>Action</th>"
            . "</tr></thead><tbody>";
    $groups = UserGroup::getAllGroups();
    foreach ($groups as $group) {
        $table .= "<tr><td>{$group->name}</td>"
                . "<td>{$group->description}</td>"
                . "<td style=\"width: 10px;\">";
        
        if ($group->name != "Administrators" && $group->name != "Users" && $group->name != "Guests") {
            $table .= "<div class=\"btn-group\" role=\"group\">"
                . "<button onclick=\"editGroup({$group->id});\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></button>"
                . "<button style=\"width: 35px;\" onclick=\"removeGroup({$group->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i></button>"
                . "</div>";
        } else {
            $table .= "<i class=\"text-sm\">Built-in</i>";
        }

        $table .= "</td></tr>";
    }
    $table .= "</tbody></table></div>";
    system\Helper::arcReturnJSON(["html" => $table]);
}