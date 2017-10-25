<?php

if (system\Helper::arcIsAjaxRequest() && count($_FILES) > 0) {
    Log::createLog("success", "arcforum", "Detected upload request.");
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            Log::createLog("success", "arcforum", "Starting image upload.");

            $filesize = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
            Log::createLog("info", "arcforum", "Upload size limit: " . $filesize->value);

            if ($_FILES['file']['size'] > $filesize->value) {
                system\Helper::arcAddMessage("danger", "Image file size exceeds limit");
                Log::createLog("danger", "arcforum", "Image exceeds size limit.");
                return;
            }
            $file_type = $_FILES['file']['type'];
            Log::createLog("info", "arcforum", "Type: " . $_FILES['file']['type']);
            if (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")) {
                system\Helper::arcAddMessage("danger", "Invalid image type, requires JPEG, JPG, GIF or PNG");
                Log::createLog("danger", "arcforum", "Invalid image type.");
                return;
            }

            Log::createLog("info", "arcforum", "Valid image type detected.");

            //$name = md5(uniqid(rand(), true));
            //$ext = explode('.', $_FILES['file']['name']);
            //$filename = $name . '.' . $ext[1];
            $filename = $_FILES['file']['name'];

            // force lowercase names
            $filename = strtolower($filename);
            $destination = system\Helper::arcGetPath(true) . "assets/forum/" . $filename;

            if (!file_exists(system\Helper::arcGetPath(true) . "assets/forum")) {
                mkdir(system\Helper::arcGetPath(true) . "assets/forum");
            }
            
            Log::createLog("info", "arcforum", "Destination: '" . $destination . "'");

            $location = $_FILES["file"]["tmp_name"];

            Log::createLog("info", "arcforum", "Source: '" . $location . "'");

            $size = getimagesize($location);

            Log::createLog("info", "arcforum", "Size: " . $size[0]);

            if ($size == 0) {
                system\Helper::arcAddMessage("danger", "Invalid image uploaded");
                Log::createLog("danger", "arcforum", "Invalid image size.");
                return;
            }
            move_uploaded_file($location, $destination);
            Log::createLog("info", "arcforum", "Image moved to image folder.");
            system\Helper::arcReturnJSON(["path" => system\Helper::arcGetPath() . "assets/forum/" . $filename]);
            Log::createLog("success", "arcforum", "Upload complete.");
        } else {
            Log::createLog("danger", "arcforum", "Upload error " . $_FILES['file']['error']);
            system\Helper::arcAddMessage("danger", "Error occured while uploading image");
        }
    }
}