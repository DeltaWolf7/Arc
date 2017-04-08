<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = Router::getByID($_POST["id"]);
        $permission->groupallowed = $_POST["group"];
        $permission->route = $_POST["route"];
        $permission->destination = $_POST["destination"];

        $group = UserGroup::getByID($_POST["group"]);
        $permissions = $group->getPermissions();
        foreach ($permissions as $perm) {
            if ($perm->route == $permission->route && $perm->id != $permission->id) {
                system\Helper::arcAddMessage("danger", "Route for this page already exists in this group");
                return;
            }
        }

        $permission->update();
        
        
        system\Helper::arcAddMessage("success", "Route saved");
    }