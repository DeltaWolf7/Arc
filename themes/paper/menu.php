<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = '<ul class="metismenu" id="menu">';

foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\"><div class=\"parent-icon\"><i class=\"{$data["icon"]}\"></i></div><div class=\"menu-title\">{$data["name"]}</div></a></li>";
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

            $submenu .= "<li><a href=\"" . $path . $data["url"] . "\"><i class=\"{$subicon}\"></i> {$data["name"]}</a></li>";   
        }

        $html .= "<li>"
                . "<a href=\"javascript:;\" class=\"has-arrow\">";
        if ($subicon != "") {
            $html .= "<div class=\"parent-icon\"><i class=\"{$subicon}\"></i></div>";
        }
        $html .= "<div class=\"menu-title\">{$grandfather}</div></a>"  
            . "<ul>{$submenu}</ul>"
                . "</li>";
    }
}

$html .= '</ul>';
echo $html;