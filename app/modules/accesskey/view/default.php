<?php
if (isset($_GET["key"])) {
    $user = AccessKey::getUserByKey(strtoupper($_GET["key"]));
    if ($user != null) {
        if ($user->enabled) {
            system\Helper::arcSetUser($user);
            if (isset($_GET["location"])) {
                system\Helper::arcRedirect($_GET["location"]);
            } else {
                system\Helper::arcRedirect();
            }
        }
    }
}
?>

<div class="page-header">
    <h1><i class="fa fa-lock"></i> Access Key</h1>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <label for="key">Enter Pre-Shared Key</label>
            <input type="key" class="form-control" id="key" maxlength="255" placeholder="00000000-0000-0000-0000-000000000000">
        </div>
    </div>
    <div class="panel-footer text-right">
        <a id="sendBtn" class="btn btn-primary"><i class="fa fa-lgoin"></i> Send</a>
    </div>
</div>
<div id="status"></div>

<script>
    $("#sendBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {key: $("#key").val()},
            complete: function (data) {
                updateStatus("status", updateStatusCallback);
            }
        });
    });

    function updateStatusCallback(data) {
        if (data.danger == 0) {
            window.location = "<?php if (isset($_GET["location"])) {
    echo $_GET["location"];
} else {
    echo system\Helper::arcGetPath();
} ?>";
        }
    }
</script>