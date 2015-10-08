<div class="page-header">
    <h1><i class="fa fa-cog"></i> Forgot Password</h1>
</div>


<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <label for="email">Email address</label>
            <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email" autocomplete="off">
        </div>
        <div id="status"></div>
    </div>
    <div class="panel-footer text-right">
        <button id="forgotBtn" class="btn btn-primary">Request Reset</button>
        <a class="btn btn-default" href="<?php echo system\Helper::arcGetModulePath(); ?>">Cancel</a>
    </div>
</div>

<script>
    $("#forgotBtn").click(function () {
        arcAjaxRequest('<?php system\Helper::arcGetDispatch(); ?>', {email: $("#email").val()}, complete, null);
    });
    
    function complete(data) {
        updateStatus("status", updateStatusCallback);
    }

    function updateStatusCallback(data) {
        if (data.danger == 0) {
            $("#email").prop("disabled", true);
            $("#forgotBtn").prop("disabled", true);
        }
    }
</script>