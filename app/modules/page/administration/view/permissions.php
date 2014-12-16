<?php
$page = new Page();
if (system\Helper::arcGetURLData("data1") != "0") {
    $page->getByID(system\Helper::arcGetURLData("data1"));
}
?>


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
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick=""><span class="fa fa-plus"></span> Add To Group</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
            </div>
        </div>
    </div>
</div>

    <?php
if (arcGetURLData("data2") == "remove") {
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

    
</script>