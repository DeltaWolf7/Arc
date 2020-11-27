<?php
if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
?>
<h4 class="mt-3">Linked Accounts</h4>
<div class="row">
    <div class="col-md-12 border-top border-primary">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">

    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-success btn-sm" onclick="addLink()"><i class="fa fa-plus"></i> Create</button>
    </div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Direction</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $crmlinks = CRMUserLink::getAllByUserID($user->id);
                foreach ($crmlinks as $link) {
                    $linkUser = User::getByID($link->linkedid);
                    ?>
            <tr>
                <td><?php echo $link->id; ?></td>
                <td><?php echo $linkUser->getFullname(); ?></td>
                <td>
                    <?php
                    if ($link->userid == $user->id) {
                        ?>
                    <i class="fas fa-long-arrow-alt-right text-success"></i>
                    <?php
                    } else {
                        ?>
                    <i class="fas fa-long-arrow-alt-left text-danger"></i>
                    <?php } ?>
                </td>
                <td><?php echo $linkUser->email; ?></td>
                <td style="width: 10px;">
                    <div class="btn-group" role="group">
                        <button style="width: 35px;" class="btn btn-danger btn-sm"
                            onclick="removeLink('<?php echo $link->id; ?>')"><i class="fa fa-remove"></i></button>
                    </div>
                </td>
            </tr>
            <?php
                }
                ?>
        </tbody>
    </table>
</div>
<?php
        }
}
?>


<div class="modal" id="editLinkModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Link</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input id="linkSearch" type="text" class="form-control" placeholder="Search.."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="searchLink('<?php echo $user->id; ?>')"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="linksearchresults">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>