<?php

if (system\Helper::arcIsAjaxRequest()) {
    ob_start();
    $modules = scandir(system\Helper::arcGetPath(true) . "app/modules");
    foreach ($modules as $module) {
        if ($module != "." && $module != "..") {
            if (file_exists(system\Helper::arcGetPath(true) . "app/modules/" . $module . "/configuration/configuration.php")) {
                echo "<h3>" . ucwords($module) . "</h3>";
                include system\Helper::arcGetPath(true) . "app/modules/" . $module . "/configuration/configuration.php";
            }
        }
    }
    $html = ob_get_contents();
    ob_end_clean();
    system\Helper::arcReturnJSON(["html" => $html]);
}          