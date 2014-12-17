<div class="page-header">
    <h1>System Settings</h1>
</div>

<table class="table table-striped" id="data">
</table>

<div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Setting</h4>
            </div>
            <div class="modal-body">
                <form role="form">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
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

    $(document).ready(function () {
        getSettings();
    });
</script>