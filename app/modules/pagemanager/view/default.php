<div class="table-responsive">
    <table class="table table-hover table-condensed table-striped" id="pages">
    </table>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Page</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title"
                                   maxlength="200" data-toggle="tooltip" data-placement="top" title="Page Title (200 characters max)">
                        </div>
                        <div class="form-group">
                            <label for="seourl">SEO Url</label>
                            <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="50"
                                   data-toggle="tooltip" data-placement="top" title="SEO Url (50 characters max)">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="sortorder">Sort Order</label>
                                    <input type="text" class="form-control" id="sortorder" placeholder="Sort Order" maxlength="5"
                                           data-toggle="tooltip" data-placement="top" title="Sort order">                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="showtitle">Show Title?</label>
                                    <select id="showtitle" class="form-control">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="metadescription">META Description</label>
                            <input type="text" class="form-control" id="metadescription" maxlength="160" placeholder="META Description" 
                                   data-toggle="tooltip" data-placement="top" title="META Description (160 characters max)">
                        </div>
                        <div class="form-group">
                            <label for="metakeywords">META Keywords</label>
                            <input type="text" class="form-control" id="metakeywords" maxlength="69" placeholder="META Keywords" 
                                   data-toggle="tooltip" data-placement="top" title="Meta Keywords (69 characters max)">
                        </div> 
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iconclass">Icon Class</label>
                                    <input type="text" class="form-control" id="iconclass" placeholder="Icon Class" maxlength="20"
                                           data-toggle="tooltip" data-placement="top" title="Icon Class">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hidelogin">Hide On Login?</label>
                                <select id="hidelogin" class="form-control">
                                    <option value="0">False</option>
                                    <option value="1">True</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="hidemenu">Hide Menu</label>
                                <select id="hidemenu" class="form-control">
                                    <option value="0">False</option>
                                    <option value="1">True</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="summernote"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="imodule">Insert Module</label>
                                    </div>
                                    <div class="col-md-8">
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
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-block" id="insertModule">Insert</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="theme">Theme Override</label>
                                    </div>
                                    <div class="col-md-10">
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

                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="savePageBtn">Save</a>
            </div>
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