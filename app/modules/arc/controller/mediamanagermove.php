<?php

if (system\Helper::arcIsAjaxRequest()) {
    $marked = json_decode($_POST['items']);
    $path = system\Helper::arcGetPath(true) . "assets";
    foreach ($marked as $item) {
        if (is_file($path . $item)) {
            rename($path . $item, $path . "/" . $_POST["movePath"] . $item);
        } 
    }

    system\Helper::arcAddMessage("success", "Selected " . ngettext("item", "items", count($marked)) . " moved");
    system\Helper::arcReturnJSON();
}