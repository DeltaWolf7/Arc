<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$html = '<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">';

foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li class=\"nav-item\"><a class=\"nav-link\" aria-current=\"page\" href=\"" . $path . $data["url"] . "\">";
            $html .= "<i class=\"{$data["icon"]}\"></i>{$data["name"]}";
            $html .= "</a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        $subicon = "";
        foreach ($parent as $child => $data) {
            // use the first icon we have for the parent icon.
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }

            $submenu .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . $path . $data["url"] . "\"><i class=\"{$subicon}\"></i> {$data["name"]}</a></li>";   
        }

        $html .=  "<h6 class=\"sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase\">"
                . "<span>{$grandfather}</span>"
                . "</h6>";

        $html .= "<ul class=\"nav flex-column\">{$submenu}</ul>"
                . "</li>";
    }
}

$html .= '</div></nav>';
echo $html;