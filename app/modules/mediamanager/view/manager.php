<div class="panel panel-primary">
    <div class="panel-heading">
        Media Browser
    </div>
    <div class="panel-body">
        <a class="btn btn-primary"><i class="fa fa-upload"></i> Upload</a>
        <a class="btn btn-primary"><i class="fa fa-folder"></i> New Folder</a>
        <a class="btn btn-primary"><i class="fa fa-close"></i> Delete</a>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <?php
            $files = scandir(system\Helper::arcGetPath(true) . "assets");
            foreach ($files as $file) {
                echo "<tr><td>{$file}</td><td></td><td></td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="panel-footer">

    </div>
</div>