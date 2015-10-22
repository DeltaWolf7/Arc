<div class="page-header">
    <h1>System Settings</h1>
</div>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-striped" id="data">
    </table>
</div>

<div id="status"></div>

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
                        <input type="text" class="form-control" id="sKey" maxlength="100" placeholder="Setting Key">
                    </div>
                    <div class="form-group">
                        <label for="sValue">Value</label>
                        <input type="text" class="form-control" id="sValue" maxlength="255" placeholder="Setting Value">
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