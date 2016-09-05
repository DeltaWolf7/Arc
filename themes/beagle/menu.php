<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = "<ul class=\"sidebar-elements\"><li class=\"divider\">Menu</li>";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\"><i class=\"{$data["icon"]}\"></i> <span>{$data["name"]}</span></a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        $subicon = "";
        foreach ($parent as $child => $data) {
            $submenu .= "<li><a href=\"" . $path . $data["url"] . "\">";
            if ($data["icon"] != "") {
                $submenu .= "<i class=\"{$data["icon"]}\"></i> ";
            }
            $submenu .= "{$data["name"]}</a></li>";
                       
            // use the first icon we have for the parent icon.
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }
        }

        $html .= "<li class=\"parent\">"
                . "<a href=\"#\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i> ";
        }
        $html .= "{$grandfather}</a>"
                . "<ul class=\"sub-menu\">{$submenu}</ul>"
                . "</li>";
    }
}
echo $html;
