<div id="listDiv" class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-striped" id="pages">
            </table>
        </div>
    </div>
</div>

<div class="panel panel-default" id="editorDiv" style="display: none;">
    <div class="panel-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#pageeditor" aria-controls="pageeditor" role="tab" data-toggle="tab">Page Editor</a></li>
            <li role="presentation"><a href="#pageproperties" aria-controls="pageproperties" role="tab" data-toggle="tab">Properties</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="pageeditor">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title"
                                   maxlength="200" data-toggle="tooltip" data-placement="top" title="Page Title (200 characters max)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seourl">SEO Url</label>
                            <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="100"
                                   data-toggle="tooltip" data-placement="top" title="SEO Url (100 characters max)">
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
                                <span class="input-group-btn"><a class="btn btn-primary btn-block" id="insertModule">Insert</a></span>
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
                            <input type="text" id="metakeywords" placeholder="Enter Keywords" data-role="tagsinput">
                          </div> 
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sortorder">Sort Order</label>
                            <input type="number" class="form-control" id="sortorder" placeholder="Sort Order">                                    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="iconclass">Icon Class</label>
                            <input type="text" class="form-control" id="iconclass" placeholder="fa fa-folder" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="showtitle" class="styled" />
                                <label for="showtitle">Show Title</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="hidemenu" class="styled" />
                                <label for="hidemenu">Hide From Menu</label>
                            </div>
                            <div class="checkbox">
                                <input id="hidelogin" class="styled" type="checkbox" />
                                <label for="hidelogin">Hide On Login</label>
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>

        <div class="text-right">
            <a class="btn btn-default" id="closeBtn">Close</a>
            <a class="btn btn-primary" id="savePageBtn">Save</a>
        </div>

    </div>
</div>


<div class="modal fade" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Delete Page</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this page?                    
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="doRemoveBtn">Yes</a>
            </div>
        </div>
    </div>
</div>