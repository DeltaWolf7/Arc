<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $groups = UserGroup::getAllGroups();
    $table = "";
    foreach ($groups as $group) {
        $userCount = count($group->getUsers());

        $table .= "<tr><td>{$group->id}</td><td>{$group->name}</td>"
                . "<td>{$group->description}</td>"
                . "<td>{$userCount}</td>"
                . "<td>";
        
        if ($group->name != "Administrators" && $group->name != "Users" && $group->name != "Guests") {
            $table .= "<button onclick=\"editGroup({$group->id});\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></button>"
                . " <button style=\"width: 35px;\" onclick=\"removeGroup({$group->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i></button>";
        } else {
            $table .= "<i>Built in</i>";
        }
        $table .= "</td></tr>";
    }
    system\Helper::arcReturnJSON(["html" => $table]);
}