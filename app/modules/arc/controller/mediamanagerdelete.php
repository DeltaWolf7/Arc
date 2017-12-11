<?php

if (system\Helper::arcIsAjaxRequest()) {
    $marked = json_decode($_POST['items']);
    $path = system\Helper::arcGetPath(true) . "assets";
    foreach ($marked as $item) {
        if (is_file($path . $item)) {
            unlink($path . $item);
        } else {
            $it = new RecursiveDirectoryIterator($path . $item, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($path . $item);
        }
    }

    system\Helper::arcAddMessage("success", "Selected " . ngettext("item", "items", count($marked)) . " deleted");
    system\Helper::arcReturnJSON();
}