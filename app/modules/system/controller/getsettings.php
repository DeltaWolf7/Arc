<?php
if (system\Helper::arcIsAjaxRequest() == true) {
    ob_start();
    $modules = scandir(system\Helper::arcGetPath(true) . "app/modules");
    foreach ($modules as $module) {
        if ($module != "." && $module != "..") {
            if (file_exists(system\Helper::arcGetPath(true) . "app/modules/" . $module . "/configuration/system.php")) {
                if (file_exists(system\Helper::arcGetPath(true) . "app/modules/" . $module . "/controller/default.php")) {
                    $module_name = "";
                    include system\Helper::arcGetPath(true) . "app/modules/" . $module . "/controller/default.php";
                }
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                       <?php echo ucwords($module); ?>
                    </div>
                    <div class="panel-body">

                        <?php
                        include system\Helper::arcGetPath(true) . "app/modules/" . $module . "/configuration/system.php";
                        ?>

                    </div>
                </div>

                <?php
            }
        }
    }
    $html = ob_get_contents();
    ob_end_clean();
    system\Helper::arcReturnJSON(["html" => $html]);
}


                
                