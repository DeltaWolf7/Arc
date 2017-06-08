<div class="card">
    <div class="card-block">

        <div role="tabpanel" id="tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li id="tabPosts" role="presentation" class="nav-item"><a href="#posts" class="nav-link active" role="tab" data-toggle="tab">Posts</a></li>
                <li id="tabCategories" role="presentation" class="nav-item"><a href="#categories" class="nav-link" role="tab" data-toggle="tab">Categories</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="posts"></div>
                <div role="tabpanel" class="tab-pane" id="categories"></div>
            </div>
        </div>

        <div id="postEditor" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" maxlength="100" />
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                        <input id="date" type="text" data-date-format="dd-mm-yyyy" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" />
                                </div>
                                <div class="form-group">
                                    <label for="seourl">SEO Url</label>
                                    <input type="text" class="form-control" id="seourl" maxlength="100" />
                                </div>
                                <div class="form-group">
                                    <label for="cat">Category</label>
                                    <select class="form-control" id="cat">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="image">
                                </div>
                                <button id="changeImage" class="btn btn-primary btn-block btn-file"><input type="file">Change Image</button>
                                <button id="removeImage" class="btn btn-danger btn-block">Remove Image</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="summernote"></div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-secondary" id="cancelPost">Close</button>
                            <button class="btn btn-primary" id="postSaveBtn">Save</button>
                        </div>
                    </div>

        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
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
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="catSave">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
