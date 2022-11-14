<?php

$menus = system\Helper::arcGetMenu();
$path = system\Helper::arcGetPath();

?>

<nav class="sidebar-nav">
    <ul id="sidebarnav">

<?php

$html = '';

foreach ($menus as $grandfather => $parent) {
    if (count($parent) == 1) {
        // only one item in this menu.
        foreach ($parent as $child => $data) {
            $html .=    '<li class="sidebar-item">' .
                            '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="' . $path . $data["url"] . '" aria-expanded="false">' .
                                '<i class="' . $data["icon"] . '"></i><span class="hide-menu">' . $data["name"] . '</span>' .
                            '</a>' .
                        '</li>';
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
 
            $submenu .= '<li class="sidebar-item">'
                    . '<a href="'. $path . $data["url"] .'" class="sidebar-link"><i class="' . $subicon . '"></i>'
                    . '<span class="hide-menu"> ' . $data["name"] . '</span></a>'
                    . '</li>';
        }

        $html .= '<li class="sidebar-item">'
                . '<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">';
        if ($subicon != "") {
            $html .= '<i class="' . $subitem . '"></i>';
        }
        $html .= '<span class="hide-menu">' . $grandfather . '</span></a>'  
            . '<ul aria-expanded="false" class="collapse first-level">' . $submenu . '</ul>'
                . '</li>';
    }
}

$html .= '</ul>';
echo $html;

?>
    </ul>
</nav>


        
        
                
               
