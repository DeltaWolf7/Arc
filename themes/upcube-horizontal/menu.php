<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();


$html = "<ul class=\"navigation-menu\">";
                          
foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li class=\"has-submenu\"><a href=\"" . $path . $data["url"] . "\"><i class=\"{$data["icon"]}\"></i> <span>{$data["name"]}</span></a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        $subicon = "";
        $split = 5;
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

            // decrement split
            $split--;
            if ($split == 0) {
                // now split to create mega menu columns.
                $submenu .= "</ul></li><li><ul>";
                $split = 5;
            }
        }

        $html .= "<li class=\"has-submenu\">"
                . "<a href=\"#\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i> ";
        }
        $html .= "{$grandfather}</a>"
                . "<ul class=\"submenu megamenu\"><li><ul>{$submenu}</ul></li></ul>"
                . "</li>";
    }
}
echo $html;
