<?php

if (system\Helper::arcIsAjaxRequest() && count($_FILES) > 0) {
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            $filesize = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");

            if ($_FILES['file']['size'] > $filesize->value) {
                system\Helper::arcAddMessage("danger", "File size exceeds limit");
                Log::createLog("danger", "user", "File exceeds size limit.");
                system\Helper::arcReturnJSON(["message" => "File size exceeds limit"]);
                return;
            }
            $file_type = $_FILES['file']['type'];
            Log::createLog("info", "user", "Type: " . $_FILES['file']['type']);

            // manage file types not allowed here.
            if (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")) {
                system\Helper::arcAddMessage("danger", "Invalid image type, requires JPEG, JPG, GIF or PNG");
                Log::createLog("danger", "user", "Invalid image type.");
                system\Helper::arcReturnJSON(["message" => "Invalid image type, requires JPEG, JPG, GIF or PNG"]);
                return;
            }
            
            $name = $_FILES["file"]["name"];
            $filename = uniqid() . ".png";
            $path = system\Helper::arcGetPath(true) . "assets/profile";
            $destination = $path . "/" . $filename;

            if (!file_exists($path)) {
                mkdir($path);
            }

            Log::createLog("info", "user", "Destination: '" . $destination . "'");

            $location = $_FILES["file"]["tmp_name"];
            $size = filesize($location);
            if ($size == 0) {
                system\Helper::arcAddMessage("danger", "Invalid file uploaded");
                Log::createLog("danger", "user", "Invalid file size.");
                system\Helper::arcReturnJSON(["message" => "Invalid file uploaded"]);
                return;
            }
            move_uploaded_file($location, $destination);
            
            $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", system\Helper::arcGetUser()->id);
            $profileImage->userid = system\Helper::arcGetUser()->id;
            $profileImage->value = $filename;
            $profileImage->update();

            system\Helper::arcAddMessage("success", "File uploaded");
            system\Helper::arcReturnJSON(["message" => "File uploaded"]);
            Log::createLog("success", "user", "Upload complete.");
        } else {
            if ($_FILES['file']['error'] == "1") {
                system\Helper::arcAddMessage("danger", "File size exceeds limit");
                system\Helper::arcReturnJSON(["message" => "File size exceeds limit"]);
                Log::createLog("danger", "user", "File exceeds size limit.");
            } else {
                Log::createLog("danger", "user", "Upload error " . $_FILES['file']['error']);
                system\Helper::arcAddMessage("danger", "Upload error " . $_FILES['file']['error']);
                system\Helper::arcReturnJSON(["message" => "Upload error " . $_FILES['file']['error']]);
            }
        }
    }
}