<?php

$menus = system\Helper::arcGetMenu(["login", "account/logout", "account/details"]);
$path = system\Helper::arcGetPath();


$html = "<ul class=\"list\">";

if (system\Helper::arcIsUserLoggedIn()) {
    $user = system\Helper::arcGetUser();
    
    $html .= "<li>"
            . " <div class=\"user-info\">"
            . "     <div class=\"admin-image\"><img src=\""
                    . $user->getProfileImage()
                    . "\" alt=\"{$user->getFullname()}\"></div>"
            . "     <div class=\"admin-action-info\"><span>Welcome</span>"
            . "         <h3>{$user->getFullname()}</h3>"
            . "             <ul>"
            . "                 <li><a data-placement=\"bottom\" title=\"Go to Account Details\" href=\"/account/details\"><i class=\"zmdi zmdi-account\"></i></a></li>"
            . "             </ul>"
            . "     </div>"
            . " </div>"
            . "</li>";
}

$html .= "<li class=\"header\">MAIN NAVIGATION</li>";

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
            $submenu .= "<li><a href=\"" . $path . $data["url"] . "\">{$data["name"]}</a></li>";
                       
            // use the first icon we have for the parent icon.
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }
        }

        $html .= "<li>"
                . "<a href=\"javascript:void(0);\" class=\"menu-toggle\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i> ";
        }
        $html .= "<span>{$grandfather}</span></a>"
                . "<ul class=\"ml-menu\">{$submenu}</ul>"
                . "</li>";
    }
}
echo $html;
