<?php

/// PROFILE
$html = "";

if (system\Helper::arcIsUserLoggedIn()) {

    $user = system\Helper::arcGetUser();
    $profileImage = $user->getProfileImage();
                                        
    $image = "";
    if (!empty($profileImage)) {
        $image = "<img class=\"img-circle img-md\" src=\"{$profileImage}\" alt=\"Profile Picture\">";
    }
                           
    $html .= "<div id=\"mainnav-profile\" class=\"mainnav-profile\">"
            . "<div class=\"profile-wrap text-center\">"
            . "<div class=\"pad-btm\">"
            . $image
            . "</div>"
            . "<p class=\"mnp-name\">";
            
    $html .= $user->getFullname()
            . "</p>"
            . "</div>"
            . "</div>";
}

/// MENU

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$html .= "<ul id=\"mainnav-menu\" class=\"list-group\"><li class=\"list-header\">Navigation</li>";

$defaultRoute = Router::getRoute("");
$defaultPage = Page::getBySEOURL($defaultRoute->destination);


$html .= "<li><a href=\"{$path}\"><i class=\"" . $defaultPage->iconclass . "\"></i><span class=\"menu-title\">" . $defaultPage->title . "</span></a></li>";

foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .= "<li><a href=\"" . $path . $data["url"] . "\"><i class=\"{$data["icon"]}\"></i><span class=\"menu-title\">{$data["name"]}</span></a></li>";
        }
    } else {
        // multi items in this menu.
        $submenu = "";
        $subicon = "";
        foreach ($parent as $child => $data) {
            $submenu .= "<li><a href=\"" . $path . $data["url"] . "\">";
            if ($data["icon"] != "") {
                $submenu .= "<i class=\"{$data["icon"]}\"></i><span class=\"menu-title\">";
            }
            $submenu .= "{$data["name"]}</a></span></li>";
                       
            // use the first icon we have for the parent icon.
            if ($subicon == "" && $data["icon"] != "") {
                $subicon = $data["icon"];
            }
        }

        $html .= "<li>"
                . "<a href=\"#\">";
        if ($subicon != "") {
            $html .= "<i class=\"{$subicon}\"></i><span class=\"menu-title\">";
        }
        $html .= "{$grandfather}</span>"
                . "<i class=\"arrow\"></i></a>"
                . "<ul class=\"collapse\" aria-expanded=\"false\">{$submenu}</ul>"
                . "</li>";
    }
}
echo $html;
