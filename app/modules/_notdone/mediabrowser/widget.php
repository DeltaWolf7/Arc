<?php
if (system\Helper::arcIsAjaxRequest()) {
    if (system\Helper::arcGetURLData("action") == "browse") {
        $path = system\Helper::arcGetPath(true) . "images";

        $files = scandir($path, SCANDIR_SORT_ASCENDING);
        $table = "";
        foreach ($files as $file) {
            $table .= "<tr><td><a onclick=\"mbClick('{$path}/{$file}')\">{$file}</a></td></tr>";
        }

        system\Helper::arcReturnJSON(["html" => $table]);
    }
} else {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Media Browser
        </div>
        <div class="panel-body">
            <table class="table table-striped" id="mediabrowser">
            </table>
        </div>
    </div>

    <script>
        function mbClick(filepath) {
            alert(filepath);
        }

        function browse() {
            $.ajax({
                url: "<?php system\Helper::arcGetWidgetPath("mediabrowser"); ?>",
                dataType: "json",
                type: "post",
                contentType: "application/x-www-form-urlencoded",
                data: {action: "browse"},
                complete: function (data) {
                    var jdata = jQuery.parseJSON(JSON.stringify(data));
                    $('#mediabrowser').html(jdata.html);
                }
            });
        }

        $(document).ready(function () {
            browse();
        });
    </script>

    <?php
}
?>