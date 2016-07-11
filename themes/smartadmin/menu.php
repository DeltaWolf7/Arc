<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = "<ul>";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\"><i class=\"{$data["icon"]}\"></i> <span class=\"menu-item-parent\">{$data["name"]}</span></a></li>";
        }
    } else {
        // multi items in this menu.

        $submenu = "";
        $subicon = "";
        foreach ($parent as $child => $data) {
            $submenu .= "<li><a href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }
        }

        $html .= "<li>"
                . "<a href=\"#\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i> ";
        }
        $html .= "<span class=\"menu-item-parent\">{$grandfather}</span></a>"
                . "<ul>{$submenu}</ul>"
                . "</li>";
    }
}
$html .= "</ul>";
echo $html;
