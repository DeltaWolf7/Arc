<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $groups = UserGroup::getAllGroups();
    $table = "<table class=\"table table-striped table-sm align-middle\">";
    $table .= "<thead class=\"text-primary\"><tr><th scope=\"col\">Route</th><th scope=\"col\">Destination</th><th scope=\"col\">Status</th><th scope=\"col\">&nbsp;</th></tr></thead><tbody>";
    foreach ($groups as $group) {
        $permissions = Router::getByGroupID($group->id);
        $table .= "<thead class=\"text-secondary\"><tr><th  scope=\"col\" colspan=\"3\"><strong>" . $group->name . "</strong></th><th scope=\"col\" class=\"text-end\"><button class=\"btn btn-primary btn-sm\" onclick=\"editPermission(" . $group->id . ",0);\"><i class=\"fa fa-plus\"></i> Create</button></th></tr></thead>";
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
                $table .= "<div class=\"badge bg-success\"><i class=\"fa fa-check\"></i> Valid</div>";
            } else {
                $table .= "<div class=\"badge bg-danger\"><i class=\"fa fa-close\"></i> Invalid</div>";
            }
            $table .= "</td>"
                    . "<td class=\"text-end\">"
                    . "<button class=\"btn btn-success btn-sm\" onclick=\"editPermission({$group->id},{$permission->id});\">"
                    . "<i class=\"fa fa-pencil\"></i></button> <button onclick=\"deletePermission({$permission->id});\" class=\"btn btn-danger btn-sm\">"
                    . "<i class=\"fa fa-remove\"></i></button></td>"
                    . "</tr>";
        }
    }
    $table .= "</tbody></table>";
    system\Helper::arcReturnJSON(["html" => $table]);
}