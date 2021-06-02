<?php

if (system\Helper::arcIsAjaxRequest() == true) {
        $permission = Router::getByID($_POST["id"]);
        $pages = Page::getAllPages(true);
        
        // route
        $data = "<label for=\"route\" class=\"form-label\">Route</label>"
                . "<select id=\"route\" class=\"form-select\">"
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
        $data .= "</select>";
        
        //destination
        $data .= "<label for=\"destination\" class=\"form-label\">Destination Override</label>"
        . "<input id=\"destination\" class=\"form-control\" value=\""
            . $permission->destination . "\"></input>";
        
        
        system\Helper::arcReturnJSON(["data" => $data]);
  }