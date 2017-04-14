<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "<div class=\"panel panel-default\">"
            . "<div class=\"panel-body\">";

    // buttons
    $html .= "<table class=\"table table-striped\"><tr><td colspan=\"2\">"
            . "<button class=\"btn btn-secondary btn-sm btn-file\"><input type=\"file\"><i class=\"fa fa-upload\"></i> Upload</button>"
            . " <button class=\"btn btn-secondary btn-sm\" data-toggle=\"popover\" placement=\"top\" title=\"Create Folder\" data-html=\"true\" data-content=\""
            . "<form class='form-inline'>"
            . "<input type='text' class='form-control' id='folderName'>"
            . " <button class='btn btn-success' onclick='createFolder()'><i class='fa fa-check'></i></button>"
            . "</form>"
            . "\"><i class=\"fa fa-folder\"></i> New Folder</button>"
            . " <button class=\"btn btn-secondary btn-sm\" onclick=\"doDelete()\"><i class=\"fa fa-trash\"></i> Delete</button>";
    if ($_POST["path"] != "") {
        $backUrl = "";
        $back = explode("/", $_POST["path"]);
        for ($i = 0; $i < count($back) - 1; $i++) {
            $backUrl .= $back[$i] . "/";
        }
        $backUrl = rtrim($backUrl, "/");
        $html .= " <button class=\"btn btn-secondary btn-sm\" onclick=\"getFolderPath('" . $backUrl . "')\"><i class=\"fa fa-level-up\"></i> Up</button>";
    }
    $html .= "</td><td class=\"text-right\" colspan=\"4\">";

    // path
    $html .= "<i class=\"fa fa-home\"></i> ";
    if ($_POST["path"] == "") {
        $html .= "/";
    } else {
        $html .= $_POST["path"];
    }
    $html .= "</td></tr>";

    // get files/folders
    $html .= GetPath($_POST["path"])
            . "</table>";
    system\Helper::arcReturnJSON(["html" => $html]);
}

function GetPath($path) {
    $fullPath = system\Helper::arcGetPath(true) . "assets/" . $path . "/";
    $webPath = system\Helper::arcGetPath() . "assets" . $path;
    $files = scandir($fullPath);

    $html = "";
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $html .= "<tr>"
                    . "<td style=\"width: 10px;\"><input type=\"checkbox\" id=\"{$file}\" onchange=\"mark('{$path}/{$file}')\"><label for=\"{$file}\"></label></td>";
            if (is_dir($fullPath . $file)) {
                // folder
                $fi = new FilesystemIterator($fullPath . $file, FilesystemIterator::SKIP_DOTS);
                $html .= "<td><i class=\"fa fa-folder-o\"></i> <a class=\"clickable\" onclick=\"getFolderPath('{$path}/{$file}')\">{$file}</a></td>"
                        . "<td style=\"width: 10px;\">folder</td>"
                        . "<td style=\"width: 10px;\">-</td>"
                        . "<td style=\"width: 100px;\">" . iterator_count($fi) . ngettext(" item", " items", iterator_count($fi)) . "</td>"
                        . "<td style=\"width: 100px;\">" . date("d M Y", filectime($fullPath . $file)) . "</td>";
            } else {
                // get file type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($finfo, $fullPath . $file);
                finfo_close($finfo);

                // file
                $html .= "<td><i class=\""
                        . GetFileTypeIcon($filetype)
                        . "\"></i> <a class=\"clickable\" onclick=\"viewFile('{$webPath}/{$file}', '{$filetype}', '"
                        . FileSizeConvert(filesize($fullPath . $file))
                        . "', '"
                        . date("d M Y", filectime($fullPath . $file))
                        . "')\">{$file}<a/></td>"
                        . "<td style=\"width: 10px;\">{$filetype}</td>"
                        . "<td style=\"width: 10px;\"><a alt=\"Copy link to clipboard\" class=\"clickable\" onclick=\"copyToClipboard('{$webPath}/{$file}')\"><i class=\"fa fa-link\"></i></a></td>"
                        . "<td style=\"width: 100px;\">" . FileSizeConvert(filesize($fullPath . $file)) . "</td>"
                        . "<td style=\"width: 100px;\">" . date("d M Y", filectime($fullPath . $file)) . "</td>";
            }
            $html .= "</tr>";
        }
    }
    // no files
    if (count($files) == 2) {
        $html .= "<tr><td colspan=\"4\" class=\"text-center\">Folder is empty.</td></tr>";
    }


    return $html;
}

function GetFileTypeIcon($file) {
    $type = explode("/", $file);

    switch ($type[0]) {
        case "image":
            return "fa fa-file-image-o";
            break;
        case "text":
            return "fa fa-file-text-o";
            break;
        case "video":
            return "fa fa-file-video-o";
            break;
        case "audio":
            return "fa fa-file-audio-o";
            break;
        default:
            switch ($type[1]) {
                case "zip":
                case "x-rar-compressed":
                case "x-7z-compressed":
                case "x-gtar":
                    return "fa fa-file-archive-o";
                    break;
                case "msword":
                    return "fa fa-file-word-o";
                    break;
                case "vnd.ms-excel":
                    return "fa fa-file-excel-o";
                    break;
                default:
                    return "fa fa-file-o";
                    break;
            }
            break;
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
            $result = strval(round($result, 2)) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}
