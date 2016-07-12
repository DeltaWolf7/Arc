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

// extra theme menu
$html .= "<li><a href=\"#\"><i class=\"fa fa-bars\"></i> <span class=\"menu-item-parent\">Theme</span></a>"
        . "<ul>"
        . "<li><a onclick=\"setMenu('menu-on-top')\">Menu Top</a></li>"
        . "<li><a onclick=\"setMenu('')\">Menu Left</a></li>"
        . "<li><a onclick=\"setMenu('minified')\">Menu Left/Minified</a></li>"
        . "<li><a onclick=\"setStyle('')\">Default</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-1')\">Dark Elegance</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-2')\">Ultra Light</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-3')\">Google Skin</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-4')\">Pixel Smash</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-5')\">Glass</a></li>"
        . "<li><a onclick=\"setStyle('smart-style-6')\">Material Design</a></li>"
        . "</ul>"
        . "</li>";

$html .= "</ul>";
echo $html;
