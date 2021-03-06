<div class="card">
    <div class="card-body">
        <div class="table-responsive" id="managerView">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="fileViewerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">File Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contentViewer">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="$('#contentViewer').html('');">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" id="newFolderModel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="folderName" class="form-label">Folder Name</label>
                <input type='text' class='form-control' id='folderName'>
            </div>
            <div class="modal-footer">
                <button class='btn btn-success' onclick='createFolder()'>Save</button>&nbsp;
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="$('#contentViewer').html('');">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" id="moveFolderModel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Move</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="moveCount"></p>
                <label for="folderName" class="form-label"><?php echo system\Helper::arcGetPath(true); ?>assets/</label>
                <input type='text' class='form-control' id='movePath' value="folder_name">
            </div>
            <div class="modal-footer">
                <button class='btn btn-success' onclick='doMove()'>Move</button>&nbsp;
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="$('#contentViewer').html('');">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->