<div class="page-header">
    <h1>Page Management</h1>
</div>


<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-striped">
            <tr><th>SEO Url</th><th>Title</th><th class="text-right"><a onclick="editPage(0);" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> New Page</a></th></tr>
            <?php
            $pages = Page::getAllPages();
            foreach ($pages as $page) {
                ?>
                <tr>
                    <td><?php echo $page->seourl; ?></td>
                    <td><?php echo $page->title; ?></td>
                    <td class="text-right"><a class="btn btn-default btn-sm" onclick="editPage(<?php echo $page->id; ?>);"><span class='fa fa-edit'></span>&nbsp;Edit</a>
                        &nbsp;<a onclick="removePage(<?php echo $page->id; ?>);" class="btn btn-default btn-sm"><span class='fa fa-remove'></span>&nbsp;Remove</button></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<div class="modal fade modal-fix" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Page</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Page Details</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" maxlength="200" value="<?php echo $page->title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="seourl">SEO Url</label>
                                        <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="50" value="<?php echo $page->seourl; ?>">
                                    </div>
                                    <?php if ($page->id != 0) { ?>
                                        <div class="form-group">
                                            <br />
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <?php
                                                    $permissions = $page->getPermissions();
                                                    echo "<div class=\"badge\">This page belongs to " . count($permissions) . " group";
                                                    if (count($permissions) > 1) {
                                                        echo "s";
                                                    }
                                                    echo ".</div>"
                                                    ?>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-primary" onclick="showPermissions();"><span class="fa fa-edit"></span>  Edit Permissions</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">META Details</h3>
                                </div>
                                <div class="panel-body">
                                        <div class="form-group">
                                        <label for="metadescription">META Description</label>
                                        <input type="text" class="form-control" id="metadescription" maxlength="160" placeholder="META Description" value="<?php echo $page->metadescription; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="metakeywords">META Keywords</label>
                                        <input type="text" class="form-control" id="metakeywords" maxlength="69" placeholder="META Keywords" value="<?php echo $page->metakeywords; ?>">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="summernote"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePage();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    var page;
    
    function editPage(pageid) {
        page = pageid;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: pageid, action: "edit"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#title").val(jdata.title);
                $("#seourl").val(jdata.seourl);
                $("#metadescription").val(jdata.metadescription);
                $("#metakeywords").val(jdata.metakeywords);
                $('.summernote').code(jdata.html);
                $("#myModal").modal('show');
            }
        });
    }
    
    function savePage() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: page, action: "save", title: "#title", seourl: "#seourl",
                metadescription: "#metadescription", metakewords: "#metakeywords",
                html: $('.summernote').code(jdata.html)},
            success: function () {
                $("#myModal").modal('hide');
            }
        });
    }
    
    function removePage(pageid) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: pageid, action: "remove"},
            success: function () {
                window.location = '<?php echo system\Helper::arcGetModulePath(); ?>';
            }
        });
    }
    
    $(document).ready(function () {
        $('.summernote').summernote({height: 250});
    });
</script>
