<div class="page-header">
    <h1>Page Management
        <?php
        if (arcGetURLData("data3") != null) {
            echo "<a href='" . arcGetModulePath() . "'><span class='fa fa-arrow-circle-left'></span></a>";
        }
        ?>
    </h1>
</div>

<?php
if (empty(arcGetURLData("data2"))) {
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <tr><th>SEO Url</th><th>Title</th><th class="text-right"><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "edit/0"; ?>'"><span class="fa fa-plus"></span> New Page</button></th></tr>
                <?php
                $pages = Page::getAllPages();
                foreach ($pages as $page) {
                    echo "<tr><td>" . $page->seourl . "</td><td>" . $page->title . "</td><td class='text-right'><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "edit/" . $page->id . "'\"><span class='fa fa-edit'></span>&nbsp;Edit</button>"
                    . "&nbsp;<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "remove/" . $page->id . "'\"><span class='fa fa-remove'></span>&nbsp;Remove</button></td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <?php
} elseif (arcGetURLData("data2") == "edit") {

    $page = new Page();
    if (arcGetURLData("data3") != "0") {
        $page->getByID(arcGetURLData("data3"));
    }
    ?>
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
                            <label for="metatitle">META Title</label>
                            <input type="text" class="form-control" id="metatitle" maxlength="55" placeholder="META Title" value="<?php echo $page->metatitle; ?>">
                        </div>
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
                    <div class="summernote"><?php echo html_entity_decode($page->content); ?></div>
                </div>
            </div>
        </div>

        <div class="text-right">

            <button type="button" class="btn btn-success" onclick="doUpdate();"><span class="fa fa-save"></span> Save</button></div>
    </form>

    <div class="modal fade" id="permissonsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Page Permissions</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr><th>Group</th><th class="text-right"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="addPermission();"><span class="fa fa-plus"></span> Create</button></th></tr>
                        <?php
                        $permissions = $page->getPermissions();
                        foreach ($permissions as $permission) {
                            $group = $permission->getGroup();
                            echo "<tr><td>" . $group->name . "</td><td class='text-right'><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "permission/remove/" . $permission->id . "/" . $page->id . "'\"><span class='fa fa-remove'></span> Remove</button>";
                            echo "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="window.location = '<?php echo arcGetModulePath() . "edit/" . $page->id; ?>'"><span class="fa fa-refresh"></span> Refresh</button>            
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addpermissonsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><span class="fa fa-close"></span> Close</span></button>
                    <h4 class="modal-title">Add New Page Permission</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pagegroup">Group</label>
                        <select id="pagegroup" class="form-control">
                            <?php
                            $groups = UserGroup::getAllGroups();
                            foreach ($groups as $group) {
                                echo "<option value='" . $group->id . "'>" . $group->name . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="ajax.send('POST', {action: 'addpermission', pageid: '<?php echo $page->id; ?>', groupid: '#pagegroup'}, '<?php arcGetDispatch(); ?>', null, true);"><span class="fa fa-plus"></span> Add To Group</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
} elseif (arcGetURLData("data2") == "remove") {
    $page = new Page();
    $page->delete(arcGetURLData("data3"));
    arcRedirect(arcGetModulePath());
} elseif (arcGetURLData("data2") == "permission" && arcGetURLData("data3") == "remove") {
    $permission = new UserPermission();
    $permission->delete(arcGetURLData("data4"));
    arcRedirect(arcGetModulePath() . "edit/" . arcGetURLData("data5"));
} elseif (arcGetURLData("data2") == "permission" && arcGetURLData("data3") == "add") {
    $permission = new UserPermission();
    $permission->delete(arcGetURLData("data4"));
    arcRedirect(arcGetModulePath() . "edit/" . arcGetURLData("data5"));
}
?>



<script>
    function addPermission() {
        $('#addpermissonsModal').modal('show');
    }

    function showPermissions() {
        $('#permissonsModal').modal('show');
    }

    function doUpdate() {
        var txt = $('.summernote').code();
        ajax.send('POST', {action: 'savepage', metatitle: '#metatitle', metadescription: '#metadescription', metakeywords: '#metakeywords', editor: txt, seourl: '#seourl', title: '#title'}, '<?php arcGetDispatch(); ?>', updateStatus, true);
    }

    $(document).ready(function () {
        $('.summernote').summernote();
    });
</script>