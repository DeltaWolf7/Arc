<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $html = "<div class=\"panel panel-primary\">"
            . "<div class=\"panel-heading\">"
            . "Media Browser"
            . "</div>"
            . "<div class=\"panel-body\">"
            . "<div class=\"row\">";

    // buttons
    $html .= "<div class=\"col-md-6\">"
            . "<a class=\"btn btn-success btn-xs btn-file\"><input type=\"file\"><i class=\"fa fa-upload\"></i> Upload</a>"
            . " <a class=\"btn btn-primary btn-xs\" data-toggle=\"popover\" placement=\"top\" title=\"Create Folder\" data-html=\"true\" data-content=\""
            . "<form class='form-inline'>"
            . "<input type='text' class='form-control' id='folderName'>"
            . " <a class='btn btn-success' onclick='createFolder()'><i class='fa fa-check'></i></a>"
            . "</form>"
            . "\"><i class=\"fa fa-folder\"></i> New Folder</a>"
            . " <a class=\"btn btn-danger btn-xs\" onclick=\"doDelete()\"><i class=\"fa fa-recycle\"></i> Delete Selected</a>"
            . " <a class=\"btn btn-primary btn-xs\" onclick=\"getLink()\"><i class=\"fa fa-link\"></i> Get Link</a>";
    if ($_POST["path"] != "") {
        $backUrl = "";
        $back = explode("/", $_POST["path"]);
        for ($i = 0; $i < count($back) - 1; $i++) {
            $backUrl .= $back[$i] . "/";
        }
        $backUrl = rtrim($backUrl, "/");
        $html .= " <a class=\"btn btn-primary btn-xs\" onclick=\"getFolderPath('" . $backUrl . "')\"><i class=\"fa fa-level-up\"></i> Up</a>";
    }
    $html .= "</div>";

    // path
    $html .= "<div class=\"col-md-6 text-right\">"
            . "<i class=\"fa fa-home\"></i> ";
    if ($_POST["path"] == "") {
        $html .= "/";
    } else {
        $html .= $_POST["path"];
    };
    $html .= "</div>";


    $html .= "</div>"
            . "</div>"
            . "<div class=\"panel-body\">";
    $html .= GetPath($_POST["path"])
            . "</div>"
            . "</div>";
    system\Helper::arcReturnJSON(["html" => $html]);
}

function GetPath($path) {
    $fullPath = system\Helper::arcGetPath(true) . "assets/" . $path . "/";
    $webPath = system\Helper::arcGetPath() . "assets" . $path;
    $files = scandir($fullPath);

    $html = "";
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $html .= "<div class=\"row\">"
                    . "<div class=\"col-md-1\" style=\"width: 10px;\"><input type=\"checkbox\" id=\"{$file}\" onchange=\"mark('{$path}/{$file}')\"><label for=\"{$file}\"></label></div>";
            if (is_dir($fullPath . $file)) {
                // folder
                $fi = new FilesystemIterator($fullPath . $file, FilesystemIterator::SKIP_DOTS);
                $html .= "<div class=\"col-md-7\"><i class=\"fa fa-folder\"></i> <a style=\"cursor:pointer;\" onclick=\"getFolderPath('{$path}/{$file}')\">{$file}</a></div>"
                        . "<div class=\"col-md-2\">" . iterator_count($fi) . ngettext(" item", " items", iterator_count($fi)) . "</div>"
                        . "<div class=\"col-md-2\">" . date("d M Y", filectime($fullPath . $file)) . "</div>";
            } else {
                // file
                $html .= "<div class=\"col-md-7\"><i class=\"fa fa-file\"></i> <a href=\"{$webPath}/{$file}\" target=\"_new\">{$file}<a/></div>"
                        . "<div class=\"col-md-2\">" . FileSizeConvert(filesize($fullPath . $file)) . "</div>"
                        . "<div class=\"col-md-2\">" . date("d M Y", filectime($fullPath . $file)) . "</div>";
            }
            $html .= "</div>";
        }
    }
    // no files
    if (count($files) == 2) {
        $html .= "<div class=\"row\"><div class=\"col-md-12 text-center\">Folder is empty.</div></div>";
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
            $result = strval(round($result, 2)) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}
