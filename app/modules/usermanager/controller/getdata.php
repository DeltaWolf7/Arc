<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $groups = UserGroup::getAllGroups();
    $table = "<table class=\"table table-hover table-condensed\">";
    $table .= "<thead><tr><th>Module</th><th>Status</th><th></th></tr></thead><tbody>";
    foreach ($groups as $group) {
        $permissions = UserPermission::getByGroupID($group->id);
        $table .= "<tr class=\"active\"><td colspan=\"2\"><strong>" . $group->name . "</strong></td><td class=\"text-right\"><a class=\"btn btn-primary btn-xs\" onclick=\"editPermission(" . $group->id . ",0);\"><i class=\"fa fa-plus\"></i> New Permission</a></td></tr>";
        foreach ($permissions as $permission) {
            $table .= "<tr><td>" . $permission->permission . "</td><td>";
            $page = Page::getBySEOURL($permission->permission);
            if ($page->id != 0) {
                $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
            } else {
                $table .= "<div class=\"label label-danger\"><i class=\"fa fa-close\"></i></div>";
            }
            $table .= "</td>"
                    . "<td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"editPermission({$group->id},{$permission->id});\"><i class=\"fa fa-pencil\"></i> Edit<a/> <a onclick=\"deletePermission({$permission->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-remove\"></i> Delete<a/></td>"
                    . "</tr>";
        }
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["data" => $table]);
}