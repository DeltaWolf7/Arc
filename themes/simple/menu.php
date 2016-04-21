<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$html = "<ul class=\"nav nav-tabs nav-stacked main-menu\">";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
        }
    } else {
        // multi items in this menu.
        $html .= "<li>"
                . "<a class=\"dropmenu\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"hidden-sm\"> {$grandfather}</span> <span class=\"label\">" . count($parent) . "</span></a>"
                . "<ul>";
        foreach ($parent as $child => $data) {
            $html .= "<li><a class=\"submenu\" href=\"" . $path . $data["url"] . "\"><span class=\"hidden-sm\"> {$data["name"]}</span></a></li>";
        }
        $html .= "</ul>"
                . "</li>";
    }
}
$html .= "</ul>";
echo $html;