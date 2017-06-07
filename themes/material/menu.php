<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

$html = "<div class=\"scrollbar-inner\">";

$user = system\Helper::arcGetUser();
if ($user != null) {

$profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $user->id);
$image = "";
if (!empty($profileImage->value)) {
    $image = system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value;
}

?>

        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="<?php echo $image; ?>" alt="">
                    <div>
                        <div class="user__name"><?php echo $user->getFullname(); ?></div>
                        <div class="user__email"><?php echo $user->email; ?></div>
                    </div>
            </div>
        </div>

<?php
}

        $html .= "<ul class=\"navigation\">";
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
                    $submenu .= "<li><a href=\"" . $path . $data["url"] . "\">";
                    if ($data["icon"] != "") {
                        $submenu .= "<i class=\"{$data["icon"]}\"></i> ";
                    }
                    $submenu .= "{$data["name"]}</a></li>";
                            
                    // use the first icon we have for the parent icon.
                    if ($subicon == "" && $data["icon"] != "") {
                        $subicon = $data["icon"];
                    }
                }

                $html .= "<li  class=\"navigation__sub\">"
                        . "<a href=\"#\">";
                if ($subicon != "") {
                    $html .= "<i class=\"{$subicon}\"></i> ";
                }
                $html .= "{$grandfather}</a>"
                        . "<ul>{$submenu}</ul>"
                        . "</li>";
            }
        }
        echo $html;

?>

    </ul>
</div>

 

                   