<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = UserPermission::getByID($_POST["id"]);
        $data = "<div class=\"form-group\"><label for=\"module\">Module</label>"
                . "<select id=\"module\" class=\"form-control\">";
        $pages = Page::getAllPages();
        foreach ($pages as $page) {
            $data .= "<option value=\"" . $page->seourl . "\"";
            if ($page->seourl == $permission->permission) {
                $data .= " selected";
            }
            $data .= ">" . $page->seourl . "</option>";
        }
        $data .= "</select></div>";
        system\Helper::arcReturnJSON(["data" => $data]);
  }