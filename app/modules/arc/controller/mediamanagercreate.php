<?php

if (system\Helper::arcIsAjaxRequest()) {

    $folder = strtolower($_POST["name"]);
    
    $destination = system\Helper::arcGetPath(true) . "assets" . $_POST["path"];
    if (substr($destination, -1) != "/") {
        $destination .= "/";
    }
    $destination .= $folder;

    if (!file_exists($destination)) {
        mkdir($destination);
    }
    
    system\Helper::arcAddMessage("success", "Folder Created");
    system\Helper::arcReturnJSON();
}