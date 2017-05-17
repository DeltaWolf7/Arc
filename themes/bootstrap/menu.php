<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = "<ul class=\"nav nav-pills flex-column\">";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        foreach ($parent as $child => $data) {
            $submenu .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
        }

        $html .= "</ul>"
            . "<span class=\"nav-title\">{$grandfather}</span>"
            . "<ul class=\"nav nav-pills flex-column\">{$submenu}</ul>"
            . "<ul class=\"nav nav-pills flex-column\">";
    }
}
echo $html;