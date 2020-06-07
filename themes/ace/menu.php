<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = "<div class=\"sidebar-inner\"><div class=\"ace-scroll flex-grow-1\" ace-scroll><ul class=\"nav has-active-border\" role=\"navigation\" aria-label=\"Main\">";

foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li class=\"nav-item\"><a href=\"" . $path . $data["url"] . "\" class=\"nav-link\"><i class=\"{$data["icon"]}\"></i>&nbsp;<span class=\"nav-text fadeable\"><span>{$data["name"]}</span></span></a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        $subicon = "";
        foreach ($parent as $child => $data) {
            $submenu .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . $path . $data["url"] . "\"><span class=\"nav-text\">{$data["name"]}</span></a></li>";
                       
            // use the first icon we have for the parent icon.
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }
        }

        $html .= "<li class=\"nav-item\">"
                . "<a href=\"#\" class=\"nav-link dropdown-toggle\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i>&nbsp;";
        }
        $html .= "<span class=\"nav-text fadeable\"><span>{$grandfather}</span></span><b class=\"caret fa fa-angle-left rt-n90\"></b></a>"
            . "<div class=\"hideable submenu collapse\">"    
            . "<ul class=\"submenu-inner\">{$submenu}</ul></div>"
                . "</li>";
    }
}

$html .= "</ul></div></div>";
echo $html;
