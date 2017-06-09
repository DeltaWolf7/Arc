<?php

if (system\Helper::arcIsAjaxRequest() && count($_FILES) > 0) {
    if (isset($_FILES['file']['name'])) {
        if (!$_FILES['file']['error']) {
            $filesize = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");

            if ($_FILES['file']['size'] > $filesize->value) {
                system\Helper::arcAddMessage("danger", "File size exceeds limit");
                system\Helper::arcReturnJSON(["message" => "File size exceeds limit"]);
                Log::createLog("danger", "arcblog", "File exceeds size limit.");
                return;
            }

            $file_type = $_FILES['file']['type'];
            Log::createLog("info", "arcblog", "Type: " . $_FILES['file']['type']);

            // manage file types not allowed here.
            if (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")) {
                system\Helper::arcAddMessage("danger", "Invalid image type, requires JPEG, JPG, GIF or PNG");
                system\Helper::arcReturnJSON(["message" => "Invalid image type, requires JPEG, JPG, GIF or PNG"]);
                Log::createLog("danger", "arcblog", "Invalid image type.");
                return;
            }
            
            $name = $_FILES["file"]["name"];
            // @ to suppress notices caused by passing in extended parameters that are not files.
            $ext = @end((explode(".", $name))); # extra () to prevent notice

            $filename = uniqid() . "." .  $ext;
            $path = system\Helper::arcGetPath(true) . "assets/arcblog";
            $destination = $path . "/" . $filename;

            if (!file_exists($path)) {
                mkdir($path);
            }

            Log::createLog("info", "arcblog", "Destination: '" . $destination . "'");

            $location = $_FILES["file"]["tmp_name"];
            $size = filesize($location);
            if ($size == 0) {
                system\Helper::arcAddMessage("danger", "Invalid file uploaded");
                system\Helper::arcReturnJSON(["message" => "Invalid file uploaded"]);
                Log::createLog("danger", "arcblog", "Invalid file size.");
                return;
            }
            move_uploaded_file($location, $destination);
            
            $blog = Blog::getByID($_POST["id"]);
            $blog->image = $filename;
            $blog->update();

            system\Helper::arcAddMessage("success", "Image uploaded");
            system\Helper::arcReturnJSON(["image" => "<img class=\"rounded img-fluid\" src=\"" . $blog->getImage() . "\">"]);
            Log::createLog("success", "arcblog", "Upload complete.");
        } else {
            if ($_FILES['file']['error'] == "1") {
                system\Helper::arcAddMessage("danger", "File size exceeds limit");
                system\Helper::arcReturnJSON(["message" => "File size exceeds limit"]);
                Log::createLog("danger", "arcblog", "File exceeds size limit.");
            } else {
                Log::createLog("danger", "arcblog", "Upload error " . $_FILES['file']['error']);
                system\Helper::arcAddMessage("danger", "Upload error " . $_FILES['file']['error']);
                system\Helper::arcReturnJSON(["message" => "Upload error " . $_FILES['file']['error']]);
            }
        }
    }
}