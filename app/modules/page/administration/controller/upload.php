<?php

if (count($_FILES) > 0) {

    echo json_encode(["status" => "danger", "data" => "here"]);
    return;

    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            $name = md5(rand(100, 200));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $destination = system\Helper::arcGetPath(true) . "app/modules/page/images/" . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo json_encode(["data" => system\Helper::arcGetPath() . "app/modules/page/images/" . $filename, "status" => "success"]);
        } else {
            echo json_encode(["status" => "danger", "data" => "Error occured while uploading image."]);
        }
    }
} else {
    echo json_encode(["status" => "danger", "data" => "No files to upload"]);
}