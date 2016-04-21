<?php
$menus = system\Helper::arcGetMenuData();
$menu = "";
?>

<ul class="nav nav-tabs nav-stacked main-menu">
    <?php
    foreach ($menus as $menu => $item) {
        if (count($item) == 1) {
            foreach ($item as $subitem => $more) {
                $menu .= "<li><a href=\"{$more["url"]}\">";
                if (strlen($more["icon"]) > 0) {
                    $menu .= "<i class=\"{$more["icon"]}\"></i>";
                }
                $menu .= "<span class=\"hidden-sm\"> {$more["name"]}</span></a></li>";
            }
        } else {
            $menu .= "<li><a class=\"dropmenu\" href=\"{$key["url"]}\">";
            if (strlen($key["icon"]) > 0) {
                $menu .= "<i class=\"{$key["icon"]}\"></i>";
            }
            $menu .= "<span class=\"hidden-sm\"> {$key["name"]}</span> <span class=\"label\">3</span></a>";
            $menu .= "<ul>";

            //<li><a class="submenu" href="ui-sliders-progress.html"><i class="fa fa-eye"></i><span class="hidden-sm"> Sliders & Progress</span></a></li>

            $menu .= "</ul>";
            $menu .= "</li>";
        }
    }
    echo $menu;
    ?>
</ul>