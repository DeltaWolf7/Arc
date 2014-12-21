<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "getdata") {
        $groups = UserGroup::getAllGroups();
        $table = "";
        foreach ($groups as $group) {
            $permissions = UserPermission::getByGroupID($group->id);
            $table .= "<h3>" . $group->name . " (" . count($permissions) . ")</h3>";
            $table .= "<table class=\"table table-striped\">";
            $table .= "<tr><th>Module</th><th>Status</th><th class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editPermission(" . $group->id . ",0);\"><span class=\"fa fa-plus\"></span> New Permission</a></th></tr>";
            foreach ($permissions as $permission) {
                $table .= "<tr><td>" . $permission->permission . "</td><td>";
                if (file_exists(system\Helper::arcGetPath(true) . "/app/modules/" . $permission->permission)) {
                    $table .= "<div class=\"label label-success\"><span class=\"fa fa-check\"></span></div>";
                } else {
                    $table .= "<div class=\"label label-danger\"><span class=\"fa fa-close\"></span></div>";
                }
                $table .= "</td>"
                        . "<td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editPermission(" . $group->id . "," . $permission->id . ");\"><span class=\"fa fa-pencil\"></span> Edit<a/> <a onclick=\"deletePermission(" . $permission->id . ");\" class=\"btn btn-default btn-sm\"><span class=\"fa fa-remove\"></span> Delete<a/></td>"
                        . "</tr>";
            }
            $table .= "</table>";
        }
        echo json_encode(["data" => $table]);
    } elseif ($_POST["action"] == "deletepermission") {
        $permission = new UserPermission();
        $permission->delete($_POST["id"]);
        echo json_encode(["status" => "success", "data" => "Permission deleted"]);
    } elseif ($_POST["action"] == "editpermission") {
        $permission = new UserPermission();
        $permission->getByID($_POST["id"]);
        $data = "<form><div class=\"form-group\"><label for=\"module\">Module</label>"
                . "<select id=\"module\" class=\"form-control\">";
        $modules = system\Helper::arcGetModules();
        foreach ($modules as $module) {
            $data .= "<option value=\"" . $module["module"] . "\">" . $module["module"] . "</option>";
        }
        $data .= "</select></div></form>";
        echo json_encode(["data" => $data]);
    }
}