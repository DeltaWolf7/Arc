<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "clearcache") {
        $thumbs = scandir(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/");
        foreach ($thumbs as $thumb) {
            if ($thumb != "." && $thumb != "..") {
                unlink(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/" . $thumb);
            }
        }
        echo json_encode(["status" => "success", "data" => "Cache has been cleaned."]);
    }
}