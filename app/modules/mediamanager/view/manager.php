<div class="panel panel-primary">
    <div class="panel-heading">
        Media Browser
    </div>
    <div class="panel-body">
        <a class="btn btn-primary btn-file"><i class="fa fa-upload"></i> Upload <input type="file"></a>
        <a class="btn btn-primary"><i class="fa fa-folder"></i> New Folder</a>
        <a class="btn btn-primary"><i class="fa fa-recycle"></i> Delete</a>
    </div>
    <div class="panel-body">
        <i class="fa fa-home"></i> / assets
    </div>
    <div class="panel-body">
        <table class="table table-striped" id="browser">
            <?php
            GetPath(system\Helper::arcGetPath(true) . "assets/");
            ?>
        </table>
    </div>
</div>

<?php

function GetPath($path) {
    $files = scandir($path);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            if (is_dir($path . $file)) {
                $fi = new FilesystemIterator($path . $file, FilesystemIterator::SKIP_DOTS);
                echo "<tr><td><i class=\"fa fa-folder\"></i> {$file}</td><td>" . iterator_count($fi) . " items</td><td>" . date("d M Y", filectime($path . $file)) . "</td></tr>";
            } else {
                echo "<tr><td><i class=\"fa fa-file\"></i> {$file}</td><td>" . FileSizeConvert(filesize($path . $file)) . "</td><td>" . date("d M Y", filectime($path . $file)) . "</td></tr>";
            }
        }
    }
}

function FileSizeConvert($bytes) {
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?>