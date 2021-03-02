<?php

if (system\Helper::arcIsAjaxRequest()) {

    $postPath = $_POST["path"];

    $html = "";

    // buttons
    $html .= "<table class=\"table table-striped small\"><tr><td colspan=\"3\">"
            . "<button class=\"btn btn-secondary btn-sm btn-file\"><input type=\"file\"><i class=\"fa fa-upload\"></i> Upload</button>"
            . " <button class=\"btn btn-secondary btn-sm\" title=\"Create Folder\" onclick=\"showCreateFolder()\">"
            . "<i class=\"fa fa-folder\"></i> New Folder</button>"
            . " <button class=\"btn btn-secondary btn-sm\" title=\"Move\" onclick=\"move()\">"
            . "<i class=\"fas fa-file-import\"></i> Move</button>"
            . " <button class=\"btn btn-secondary btn-sm\" onclick=\"doDelete()\"><i class=\"fa fa-trash\"></i> Delete</button>";
    if ($postPath != "") {
        $backUrl = "";
        $back = explode("/", $postPath);
        for ($i = 0; $i < count($back) - 1; $i++) {
            $backUrl .= $back[$i] . "/";
        }
        $backUrl = rtrim($backUrl, "/");
        $html .= " <button class=\"btn btn-secondary btn-sm\" onclick=\"getFolderPath('" . $backUrl . "')\"><i class=\"fa fa-level-up\"></i> Up</button>";
    }
    $html .= "</td><td class=\"text-right\" colspan=\"4\">";

    // path
    $html .= "<i class=\"fa fa-home\"></i> ";
    if ($postPath == "") {
        $html .= "/";
    } else {
        $html .= $postPath;
    }
    $html .= "</td></tr>";

    // get files/folders
    $html .= GetPath($postPath)
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
                        . "<td style=\"width: 10px;\"></td>"
                        . "<td style=\"width: 10px;\">folder</td>"
                        . "<td style=\"width: 30px;\">-</td>"
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
                        . "<td style=\"width: 30px;\">";
                        if (substr($filetype, 0, 5) === "image") {
                         $html .= "<img src=\"{$webPath}/{$file}\" style=\"width: 30px;\" />";   
                        }
                $html .= "</td>"
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
    $result = "";
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
