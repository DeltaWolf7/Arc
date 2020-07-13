<?php

if (system\Helper::arcIsAjaxRequest()) {
    $table = "<table class=\"table table-striped table-responsive\">"
            . "<thead><tr><th>Name</th><th>Description</th>"
            . "<th class=\"text-right\"><button onclick=\"editGroup(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> Create</button></th>"
            . "</tr></thead><tbody>";
    $groups = UserGroup::getAllGroups();
    foreach ($groups as $group) {
        $table .= "<tr><td>{$group->name}</td>"
                . "<td>{$group->description}</td>"
                . "<td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<button onclick=\"editGroup({$group->id});\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Edit</button>"
                . "<button onclick=\"removeGroup({$group->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i> Remove</button>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}