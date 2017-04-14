<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $groups = UserGroup::getAllGroups();
    $table = "<table class=\"table table-hover table-sm\">";
    $table .= "<thead><tr><th>Route</th><th>Destination</th><th>Status</th><th>&nbsp;</th></tr></thead><tbody>";
    foreach ($groups as $group) {
        $permissions = Router::getByGroupID($group->id);
        $table .= "<tr class=\"active\"><td colspan=\"3\"><strong>" . $group->name . "</strong></td><td class=\"text-right\"><button class=\"btn btn-primary btn-sm\" onclick=\"editPermission(" . $group->id . ",0);\"><i class=\"fa fa-plus\"></i> Create</button></td></tr>";
        foreach ($permissions as $permission) {
            $table .= "<tr><td>" . $permission->route . "</td><td>";
            $table .= $permission->destination . "</td><td>";
            $page = null;
            if (strlen($permission->destination) > 0) {
                $page = Page::getBySEOURL($permission->destination);
            } else {
                $page = Page::getBySEOURL($permission->route);
            }
            if ($page->id != 0) {
                $table .= "<div class=\"badge badge-success\"><i class=\"fa fa-check\"></i> Valid</div>";
            } else {
                $table .= "<div class=\"badge badge-danger\"><i class=\"fa fa-close\"></i> Invalid</div>";
            }
            $table .= "</td>"
                    . "<td class=\"text-right\"><div class=\"btn-group\"><button class=\"btn btn-success btn-sm\" onclick=\"editPermission({$group->id},{$permission->id});\"><i class=\"fa fa-pencil\"></i> Edit</button><button onclick=\"deletePermission({$permission->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i> Remove</button></div></td>"
                    . "</tr>";
        }
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}