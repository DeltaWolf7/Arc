<div class="card">
    <div class="card-body table-responsive" id="listDiv">
        <table class="table table-striped table-sm align-middle" id="pages">
        </table>
    </div>

    <div class="card-body" id="editorDiv" style="display: none;">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pageeditor-tab" data-bs-toggle="tab" data-bs-target="#pageeditor"
                    type="button" role="tab" aria-controls="pageeditor" aria-selected="true"">Page Editor</button>
            </li>
            <li role=" presentation" class="nav-item">
                    <button class="nav-link" id="pageproperties-tab" data-bs-toggle="tab"
                        data-bs-target="#pageproperties" type="button" role="tab" aria-controls="pageproperties"
                        aria-selected="false">Properties</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade show active" id="pageeditor" role="tabpanel"
                aria-labelledby="pageeditor-tab">

                <div class="row">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" maxlength="200">
                    </div>
                    <div class="col-md-6">

                        <label for="seourl" class="form-label">SEO Url</label>
                        <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="100">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">

                        <div id="summernote"></div>

                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">

                        <div class="input-group">
                            <span class="input-group-addon mt-1">Modules&nbsp;</span>
                            <select id="imodule" class="form-select">
                                <?php
                                            $modules = scandir(system\Helper::arcGetPath(true) . "app/modules");
                                            foreach ($modules as $module) {
                                                if ($module != "." && $module != "..") {
                                                    if (file_exists(system\Helper::arcGetPath(true) . "app/modules/{$module}/view")) {
                                                        $views = scandir(system\Helper::arcGetPath(true) . "app/modules/{$module}/view");
                                                        foreach ($views as $view) {
                                                            if ($view != "." && $view != "..") {
                                                                echo "<option value=\"module:{$module}:" . substr($view, 0, -4) . "\">$module -> " . substr($view, 0, -4) . "</option>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="insertModule">Insert</button>
                            </span>

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="input-group">
                            <span class="input-group-addon mt-1">Theme&nbsp;</span>
                            <select id="theme" class="form-select">
                                <option value="none">No Override</option>
                                <?php
                                            $themes = scandir(system\Helper::arcGetPath(true) . "themes");
                                            foreach ($themes as $theme) {
                                                if ($theme != "." && $theme != "..") {
                                                    echo "<option value=\"{$theme}\">{$theme}</option>";
                                                }
                                            }
                                            ?>
                            </select>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Properties Panel /-->
            <div role="tabpanel" class="tab-pane fade" id="pageproperties" role="tabpanel"
                aria-labelledby="pageproperties-tab">
                <div class="row">
                    <div class="col-md-6">

                        <label for="metadescription" class="form-label">META Description</label>
                        <input type="text" class="form-control" id="metadescription" placeholder="Enter Description">

                    </div>
                    <div class="col-md-6">

                        <label for="metakeywords" class="form-label">META Keywords</label>
                        <input type="text" id="metakeywords" placeholder="Enter Keywords" class="form-control">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                        <label for="sortorder" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sortorder" placeholder="Sort Order">

                    </div>
                    <div class="col-md-3">

                        <label for="iconclass" class="form-label">Icon Class</label>
                        <input type="text" class="form-control" id="iconclass" placeholder="fa fa-folder"
                            maxlength="50">

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <label for="showtitle" class="form-label">Show Title</label>
                        <select id="showtitle" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="hidelogin" class="form-label">Hide On Login</label>
                        <select id="hidelogin" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="hidemenu" class="form-label">Hide From Menu</label>
                        <select id="hidemenu" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end mt-2">
            <button class="btn btn-secondary" id="closeBtn">Close</button>
            <button class="btn btn-primary" id="savePageBtn">Save</button>
        </div>

    </div>
</div>


<div class="modal" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this page?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button class="btn btn-primary" id="doRemoveBtn">Yes</button>
            </div>
        </div>
    </div>
</div>