<div id="listDiv" class="panel panel-default">
    <div class="panel-body">
            <table class="table table-hover table-sm table-striped" id="pages">
            </table>
    </div>
</div>

<div class="panel panel-default" id="editorDiv" style="display: none;">
    <div class="panel-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="nav-item"><a href="#pageeditor" aria-controls="pageeditor" role="tab" data-toggle="tab" class="nav-link active">Page Editor</a></li>
            <li role="presentation" class="nav-item"><a href="#pageproperties" aria-controls="pageproperties" role="tab" data-toggle="tab" class="nav-link">Properties</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="pageeditor">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" maxlength="200">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seourl">SEO Url</label>
                            <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="100">
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Modules</span>
                                <select id="imodule" class="form-control">
                                    <?php
                                    $modules = scandir(system\Helper::arcGetPath(true) . "app/modules");
                                    foreach ($modules as $module) {
                                        if ($module != "." && $module != "..") {
                                            if (file_exists(system\Helper::arcGetPath(true) . "app/modules/{$module}/view")) {
                                                $views = scandir(system\Helper::arcGetPath(true) . "app/modules/{$module}/view");
                                                foreach ($views as $view) {
                                                    if ($view != "." && $view != "..") {
                                                        echo "<option value=\"{{module:{$module}:" . substr($view, 0, -4) . "}}\">{$module}:" . substr($view, 0, -4) . "</option>";
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
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Theme</span>
                                <select id="theme" class="form-control">
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

            </div>
            <!-- Properties Panel /-->
            <div role="tabpanel" class="tab-pane" id="pageproperties">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="metadescription">META Description</label>
                            <input type="text" class="form-control" id="metadescription" placeholder="Enter Description">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="metakeywords">META Keywords</label>
                            <input type="text" id="metakeywords" placeholder="Enter Keywords" class="form-control">
                          </div> 
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sortorder">Sort Order</label>
                            <input type="number" class="form-control" id="sortorder" placeholder="Sort Order">                                    
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="iconclass">Icon Class</label>
                            <input type="text" class="form-control" id="iconclass" placeholder="fa fa-folder" maxlength="50">
                        </div>
                    </div>
                </div>
                <div class="row">

                            <div class="col-md-3">
                            <label for="showtitle">Show Title</label>
                            <select id="showtitle" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            </div>
                        <div class="col-md-3">    
                        <label for="hidelogin">Hide On Login</label>
                            <select id="hidelogin" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-3">   
                            <label for="hidemenu">Hide From Menu</label>
                            <select id="hidemenu" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
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


<div class="modal fade" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Page</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this page?                    
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">No</button>
                <button class="btn btn-primary" id="doRemoveBtn">Yes</button>
            </div>
        </div>
    </div>
</div>
