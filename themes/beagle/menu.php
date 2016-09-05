<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$html = "<ul class=\"nav navbar-nav\">";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
        }
    } else {
        // multi items in this menu.
        $html .= "<li class=\"dropdown\">"
                . "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">"
                . "{$grandfather} <i class=\"mdi mdi-caret-down\"></i></a>"
                . "<ul role=\"menu\" class=\"dropdown-menu\">";
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
        }
        $html .= "</ul>"
                . "</li>";
    }
}
$html .= "</ul>";
echo $html;