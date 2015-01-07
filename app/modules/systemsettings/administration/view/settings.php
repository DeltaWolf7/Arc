<div class="page-header">
    <h1>System Settings</h1>
</div>

<table class="table table-striped" id="data">
</table>

<div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Setting</h4>
            </div>
            <div class="modal-body">
              
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="sKey">Key</label>
                            <input type="text" class="form-control" id="sKey" maxlength="160" placeholder="Setting Key">
                        </div>
                        <div class="form-group">
                            <label for="sValue">Value</label>
                            <input type="text" class="form-control" id="sValue" maxlength="69" placeholder="Setting Value">
                        </div> 
                    </div>
            
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveSettingBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Delete Setting</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this setting?                    
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="doDeleteBtn">Yes</a>
            </div>
        </div>
    </div>
</div>

<script>
    var kstring;

    function getSettings() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "settings"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#data').html(jdata.html);
            }
        });
    }

    function editSetting(keystring) {
        kstring = keystring;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "editsetting", key: keystring},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#sKey').val(jdata.skey);
                $('#sValue').val(jdata.svalue);
            },
            complete: function () {
                $("#editSetting").modal("show");
            }
        });
    }

    function deleteSetting(keystring) {
        kstring = keystring;
        $("#deleteSetting").modal("show");
    }

    $("#doDeleteBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletesetting", key: kstring},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                $("#deleteSetting").modal("hide");
                getSettings();
            }
        });
    });

    $("#saveSettingBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savesetting", key: kstring, value: $('#sValue').val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                $("#editSetting").modal("hide");
                getSettings();
            }
        });
    });

    $(document).ready(function () {
        getSettings();
    });
</script>