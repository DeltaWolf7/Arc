<?php

if (system\Helper::arcIsAjaxRequest()) {
    $table = "<div class=\"text-right mb-2\">"
        . "<button onclick=\"editGroup(0);\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-plus\"></i> Create Group</button>&nbsp;"    
        . "<button class=\"btn btn-primary btn-sm\" onclick=\"location.reload()\"><i class=\"fas fa-list\"></i> View Users</button></div>";
    $table .= "<div class=\"table-responsive\"><table class=\"table table-striped\">"
            . "<thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Users</th><th>Action</th>"
            . "</tr></thead><tbody>";
    $groups = UserGroup::getAllGroups();
    foreach ($groups as $group) {
        $userCount = count($group->getUsers());

        $table .= "<tr><td>{$group->id}</td><td>{$group->name}</td>"
                . "<td>{$group->description}</td>"
                . "<td>{$userCount}</td>"
                . "<td style=\"width: 10px;\">";
        
        $table .= "<div class=\"btn-group\" role=\"group\">"
                . "<button onclick=\"viewGroup({$group->id});\" class=\"btn btn-secondary btn-sm\"><i class=\"fa fa-users\"></i></button>";
        if ($group->name != "Administrators" && $group->name != "Users" && $group->name != "Guests") {
            $table .= "<button onclick=\"editGroup({$group->id});\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></button>"
                . "<button style=\"width: 35px;\" onclick=\"removeGroup({$group->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i></button>"
                . "</div>";
        }

        $table .= "</div>";

        $table .= "</td></tr>";
    }
    $table .= "</tbody></table></div>";
    system\Helper::arcReturnJSON(["html" => $table]);
}