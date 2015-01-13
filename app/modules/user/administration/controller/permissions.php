<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "getdata") {
        $groups = UserGroup::getAllGroups();
        $table = "";
        foreach ($groups as $group) {
            $permissions = UserPermission::getByGroupID($group->id);
            $table .= "<h3>{$group->name} (" . count($permissions) . ")</h3>";
            $table .= "<table class=\"table table-striped\">";
            $table .= "<tr><th>Module</th><th>Status</th><th class=\"text-right\"><a class=\"btn btn-primary btn-sm\" onclick=\"editPermission(" . $group->id . ",0);\"><i class=\"fa fa-plus\"></i> New Permission</a></th></tr>";
            foreach ($permissions as $permission) {
                $table .= "<tr><td>" . $permission->permission . "</td><td>";
                if (file_exists(system\Helper::arcGetPath(true) . "/app/modules/{$permission->permission}")) {
                    $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
                } else {
                    $table .= "<div class=\"label label-danger\"><i class=\"fa fa-close\"></i></div>";
                }
                $table .= "</td>"
                        . "<td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editPermission({$group->id},{$permission->id});\"><i class=\"fa fa-pencil\"></i> Edit<a/> <a onclick=\"deletePermission({$permission->id});\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Delete<a/></td>"
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
        $data = "<div class=\"form-group\"><label for=\"module\">Module</label>"
                . "<select id=\"module\" class=\"form-control\">";
        $modules = system\Helper::arcGetModules();
        foreach ($modules as $module) {
            $data .= "<option value=\"" . $module["module"] . "\"";
            if ($module["module"] == $permission->permission) {
                $data .= " selected";
            }
            $data .= ">" . $module["module"] . "</option>";
        }
        $data .= "</select></div>";
        echo json_encode(["data" => $data]);
    } elseif ($_POST["action"] == "savepermission") {
        $permission = new UserPermission();
        $permission->getByID($_POST["id"]);
        $permission->groupid = $_POST["group"];
        $permission->permission = $_POST["module"];
        
        $group = new UserGroup();
        $group->getByID($_POST["group"]);
        $permissions = $group->getPermissions();
        foreach ($permissions as $perm) {
            if ($perm->permission == $permission->permission && $perm->id != $permission->id) {
                echo json_encode(["status" => "danger", "data" => "Permission for this module already exists in this group"]);
                return;
            }
        }
        
        $permission->update();
        echo json_encode(["status" => "success", "data" => "Permission saved"]);
    }
}