<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $route = Router::getByID($_POST["id"]);
        $route->groupallowed = $_POST["group"];
        $route->route = $_POST["route"];
        $route->destination = $_POST["destination"];

        $group = UserGroup::getByID($_POST["group"]);
        $routes = $group->getPermissions();
        foreach ($routes as $perm) {
            if ($perm->route == $route->route && $perm->id != $route->id) {
                system\Helper::arcAddMessage("danger", "Route for this page already exists in this group");
                return;
            }
        }

        $route->update();
        
        
        system\Helper::arcAddMessage("success", "Route saved");
        system\Helper::arcReturnJSON();
    }