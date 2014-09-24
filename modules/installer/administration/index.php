<div class="page-header">
    <h1>Module Installer</h1>
</div>

<?php
if (!empty(arcGetURLData("data3"))) {
    deleteDir($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("data3"));
}

function deleteDir($dirPath) {
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException($dirPath . "must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != "/") {
        $dirPath .= "/";
    }
    $files = glob($dirPath . "*", GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
?>

<form role="form" enctype="multipart/form-data" method="POST" action="<?php arcGetModulePath(); ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Installer</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="upload">Upload</label>
                <input maxlength="100" type="file" class="form-control" id="upload" name="file" placeholder="Upload module">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Install</button>
</form>
<br /><br />

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Installed Modules</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <tr><th>Module</th><th>&nbsp;</th></tr>
            <?php
            $modules = arcGetModules();
            foreach ($modules as $module) {
                echo "<tr><td>" . $module["module"] . "</td>" . 
                        "<td class='text-right'><a href='" . arcGetModulePath() . "remove/" . $module["module"] . "'><span class='fa fa-remove'></span></a></td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php
if (isset($_FILES["file"])) {
    $source = $_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/";
    $destination = $_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/";
    move_uploaded_file($_FILES["file"]["tmp_name"], $source . $_FILES["file"]["name"]);
    $zip = new ZipArchive;
    if ($zip->open($source . $_FILES["file"]["name"]) === TRUE) {
        $zip->extractTo($destination);
        $zip->close();
        unlink($source . $_FILES["file"]["name"]);

        $modules = arcGetModules();
        foreach ($modules as $module) {
            if (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . $module["module"] . "/sql/install.sql")) {
                $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . $module["module"] . "/sql/install.sql");
                arcDatabase()->query($sql);
                deleteDir($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . $module["module"] . "/sql/");
            }
        }
        echo "<div class='alert alert-success' role='alert'>Module installed</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Unable to extract from archive</div>";
    }
}
?>