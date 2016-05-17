<?php

if (system\Helper::arcIsAjaxRequest()) {
    $html = "<div class=\"panel panel-primary\">"
            . "<div class=\"panel-heading\">"
            . "Media Browser"
            . "</div>"
            . "<div class=\"panel-body\">"
            . "<a class=\"btn btn-primary btn-file\"><i class=\"fa fa-upload\"></i> Upload <input type=\"file\"></a>"
            . " <a class=\"btn btn-primary\"><i class=\"fa fa-folder\"></i> New Folder</a>"
            . "</div>"
            . "<div class=\"panel-body\">"
            . "<i class=\"fa fa-home\"></i> /" . $_POST["path"];


    if ($_POST["path"] != "assets/") {
        $backUrl = "";
        $back = explode("/", $_POST["path"]);
        for ($i = 0; $i < count($back) - 1; $i++) {
            $backUrl .= $back[$i]. "/";
        }
        $html .= " <a onclick=\"getPath('" . $backUrl . "')\"><i class=\"fa fa-level-up\"></i></a>";
    }
    
    $html.= "</div>"
            . "<div class=\"panel-body\">"
            . "<table class=\"table table-striped\" id=\"browser\">";
    $html .= GetPath($_POST["path"]);
    $html .= "</table>"
            . "</div>"
            . "</div>";
    system\Helper::arcReturnJSON(["html" => $html]);
}

function GetPath($path) {
    $files = scandir(system\Helper::arcGetPath(true) . $path);
    $html = "";
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            if (is_dir($path . $file)) {
                $fi = new FilesystemIterator($path . $file, FilesystemIterator::SKIP_DOTS);
                $html .= "<tr><td><a onclick=\"getPath('{$path}{$file}')\"><i class=\"fa fa-folder\"></i> {$file}</a></td><td>" . iterator_count($fi) . " items</td><td>" . date("d M Y", filectime($path . $file)) . "</td></tr>";
            } else {
                $html .= "<tr><td><a href=\"" . system\Helper::arcGetPath() . "{$path}{$file}\" target=\"_new\"><i class=\"fa fa-file\"></i> {$file}<a/></td><td>" . FileSizeConvert(filesize($path . $file)) . "</td><td>" . date("d M Y", filectime($path . $file)) . "</td></tr>";
            }
        }
    }
    return $html;
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
