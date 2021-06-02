<?php
if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
?>
<div class="card mt-3">
    <div class="card-body">
        <h4>Linked Accounts</h4>
        <div class="row">
            <div class="col-md-12 border-top border-primary">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">

            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary btn-sm" onclick="addLink()"><i class="fa fa-plus"></i> Create</button>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped" aria-label="Links">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Direction</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 100px;">Action</th>
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
                        <td class="text-end">
                   
                                <button class="btn btn-danger btn-sm"
                                    onclick="removeLink('<?php echo $link->id; ?>')"><i
                                        class="fa fa-remove"></i></button>
         
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
        }
}
?>


<div class="modal" id="editLinkModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>