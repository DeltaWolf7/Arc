<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = Router::getByID($_POST["id"]);
        $pages = Page::getAllPages();
        
        // route
        $data = "<div class=\"form-group\"><label for=\"route\">Route</label>"
                . "<select id=\"route\" class=\"form-control\">"
                . "<option value=\"\"";
        if ($permission->route == "") {
            $data .= "selected";
        }
        
        $data .= ">Default Path (\"/\")</option>";
        
        
        foreach ($pages as $page) {
            $data .= "<option value=\"" . $page->seourl . "\"";
            if ($page->seourl == $permission->route) {
                $data .= " selected";
            }
            $data .= ">" . $page->seourl . "</option>";
        }
        $data .= "</select></div>";
        
        //destination
        $data .= "<div class=\"form-group\"><label for=\"destination\">Destination</label>"
                . "<select id=\"destination\" class=\"form-control\">"
                . "<option value=\"\"";
        
        if ($permission->route == "/") {
            $data .= "selected";
        }
        
        $data .= ">No Override</option>";
        
        foreach ($pages as $page) {
            $data .= "<option value=\"" . $page->seourl . "\"";
            if ($page->seourl == $permission->destination) {
                $data .= " selected";
            }
            $data .= ">" . $page->seourl . "</option>";
        }
        $data .= "</select></div>";
        
        
        system\Helper::arcReturnJSON(["data" => $data]);
  }