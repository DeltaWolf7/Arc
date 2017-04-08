<p class="text-right"><a class="btn btn-default btn-xs" id="clearCache"><i class="fa fa-trash-o"></i> Clear Cache</a></p>
<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#" aria-controls="posts" role="tab" data-toggle="tab" id="posts">Posts</a></li>
        <li role="presentation"><a href="#" aria-controls="categories" role="tab" data-toggle="tab" id="categories">Categories</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active table-responsive" id="data">
        </div>
    </div>
</div>

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>SEO Url</label>
                            <input type="text" class="form-control" id="seourl" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" class="form-control" id="tags" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <div class='input-group date' id='date'>
                                <input id='dateData' type='text' class="form-control" data-date-format="DD/MM/YYYY"/>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group" id="image">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="summernote"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" id="cat" size="5">"
                                <?php
                                $categories = BlogCategory::getAllCategories();
                                foreach ($categories as $cat) {
                                    echo "<option value=\"" . $cat->name . "\">" . $cat->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" id="addPostCat"><i class="fa fa-edit"></i> Add To Category</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="selected">
                            <label>Selected Categories</label>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" id="remPostCat"><i class="fa fa-remove"></i> Remove From Category</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="postSaveBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="cattitle" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>SEO Url</label>
                            <input type="text" class="form-control" id="catseourl" maxlength="100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="catSave">Save</a>
            </div>
        </div>
    </div>
</div>
