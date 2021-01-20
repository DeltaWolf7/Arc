<div class="card">
    <div class="card-body" id="listDiv">
        <table class="table table-striped table-sm" id="pages" aria-label="Emails">
        </table>
    </div>

    <div class="card-body" id="editorDiv" style="display: none;">

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="pageeditor">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="key">Key</label>
                                    <input type="text" class="form-control" id="key" placeholder="Key" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Subject" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div id="summernote"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="text-right">
                    <button class="btn btn-secondary" id="closeBtn">Close</button>
                    <button class="btn btn-primary" id="savePageBtn">Save</button>
                </div>
                </div>

            </div>
        </div>


        <div class="modal" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Delete email</h5>
                        <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to permanently delete this email?                    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button class="btn btn-primary" id="doRemoveBtn">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                        </div>