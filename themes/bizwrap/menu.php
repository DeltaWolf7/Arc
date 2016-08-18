<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$count = 0;
$html = "<ul id=\"menu\" class=\"unstyled accordion collapse in\">";
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\"><i class=\"{$data["icon"]}\"></i> {$data["name"]}</a></li>";
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

        $html .= "<li class=\"accordion-group\">"
                . "<a data-parent=\"#menu\" data-toggle=\"collapse\" class=\"accordion-toggle\" data-target=\"#nav{$count}\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i> ";
        }
        $html .= "<span class=\"menu-item-parent\">{$grandfather}</span></a>"
                . "<ul class=\"collapse \" id=\"nav{$count}\">{$submenu}</ul>"
                . "</li>";
    }
    $count++;
}

$html .= "</ul>";
echo $html;
