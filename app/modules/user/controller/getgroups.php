<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<table class=\"table table-hover table-condensed\">"
            . "<thead><tr><th>Name</th><th>Description</th>"
            . "<th class=\"text-right\"><a onclick=\"editGroup(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i></a></th>"
            . "</tr></thead><tbody>";
    $groups = UserGroup::getAllGroups();
    foreach ($groups as $group) {
        $table .= "<tr><td>{$group->name}</td>"
                . "<td>{$group->description}</td>"
                . "<td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<a onclick=\"editGroup({$group->id});\" class=\"btn btn-success btn-xs\">"
                . "<i class=\"fa fa-pencil\"></i></a>"
                . "&nbsp;<a onclick=\"removeGroup({$group->id});\" class=\"btn btn-danger btn-xs\">"
                . "<i class=\"fa fa-remove\"></i></a>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    echo json_encode(["html" => $table]);
}