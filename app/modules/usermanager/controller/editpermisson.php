<?php

if (system\Helper::arcIsAjaxRequest() == true) {
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
  }