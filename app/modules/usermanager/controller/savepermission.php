<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = new UserPermission();
        $permission->getByID($_POST["id"]);
        $permission->groupid = $_POST["group"];
        $permission->permission = $_POST["module"];

        $group = new UserGroup();
        $group->getByID($_POST["group"]);
        $permissions = $group->getPermissions();
        foreach ($permissions as $perm) {
            if ($perm->permission == $permission->permission && $perm->id != $permission->id) {
                system\Helper::arcAddMessage("danger", "Permission for this module already exists in this group");
                return;
            }
        }

        $permission->update();
        system\Helper::arcAddMessage("success", "Permission saved");
    }