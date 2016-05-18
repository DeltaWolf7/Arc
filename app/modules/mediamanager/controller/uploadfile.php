<?php

if (system\Helper::arcIsAjaxRequest() && count($_FILES) > 0) {
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            Log::createLog("success", "mediamanager", "Starting file upload.");

            $filesize = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
            Log::createLog("info", "mediamanager", "Upload size limit: " . $filesize->value);

            if ($_FILES['file']['size'] > $filesize->value) {
                system\Helper::arcAddMessage("danger", "File size exceeds limit");
                Log::createLog("danger", "mediamanager", "File exceeds size limit.");
                return;
            }
            $file_type = $_FILES['file']['type'];
            Log::createLog("info", "arc", "Type: " . $_FILES['file']['type']);

            // manage file types not allowed here.
            if (($file_type == "application/octet-stream") || ($file_type == "text/html") || ($file_type == "application/x-msdownload")) {
                system\Helper::arcAddMessage("danger", "This type of file is not allowed. ({$file_type})");
                Log::createLog("danger", "mediamanager", "Blocked file type: {$file_type}");
                return;
            }

            $filename = $_FILES['file']['name'];

            // force lowercase names
            $filename = strtolower($filename);
            $destination = system\Helper::arcGetPath(true) . $_POST["path"];
            if (substr($destination, -1) != "/") {
                $destination .= "/";
            }
            $destination .= $filename;

            if (!file_exists(system\Helper::arcGetPath(true) . $_POST["path"])) {
                mkdir(system\Helper::arcGetPath(true) . $_POST["path"]);
            }

            Log::createLog("info", "mediamanager", "Destination: '" . $destination . "'");

            $location = $_FILES["file"]["tmp_name"];

            Log::createLog("info", "mediamanager", "Source: '" . $location . "'");

            $size = filesize($location);

            Log::createLog("info", "mediamanager", "Size: " . $size[0]);

            if ($size == 0) {
                system\Helper::arcAddMessage("danger", "Invalid file uploaded");
                Log::createLog("danger", "mediamanager", "Invalid file size.");
                return;
            }
            move_uploaded_file($location, $destination);
            Log::createLog("info", "mediamanager", "File moved to image folder.");
            system\Helper::arcAddMessage("success", "File uploaded");
            Log::createLog("success", "mediamanager", "Upload complete.");
        } else {
            Log::createLog("danger", "mediamanager", "Upload error " . $_FILES['file']['error']);
            system\Helper::arcAddMessage("danger", "Error occured while uploading file");
        }
    }
}