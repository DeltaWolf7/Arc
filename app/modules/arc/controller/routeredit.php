<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = Router::getByID($_POST["id"]);
        $pages = Page::getAllPages(true);
        
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
        $data .= "<div class=\"form-group\">"
            . "<label for=\"destination\">Destination Override</label><input id=\"destination\" class=\"form-control\" value=\""
            . $permission->destination . "\"></input>"
            . "</div>";
        
        
        system\Helper::arcReturnJSON(["data" => $data]);
  }