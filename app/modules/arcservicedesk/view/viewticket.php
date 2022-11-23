<?php
$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());
$ticket = ArcServiceDeskTicket::getByID($uri[count($uri) - 1]);
$reporter = User::getByID($ticket->userid);
$assigned = User::getByID($ticket->assignedto);
if ($assigned->id == 0) {
    $assigned->firstname = "Unassigned";
}
$admins = UserGroup::getByName("Administrators");
$admin_users = $admins->getUsers();
$admin_ids = [];
$admin_names = [];
foreach ($admin_users as $admin) {
    $admin_ids[] = $admin->id;
    $admin_names[] = $admin->getFullname();
}
$comments = ArcServiceDeskComment::getAllByTicketID($ticket->id);
?>

<div class="row">
    <div class="col-md-9">
        <h5><?php echo $ticket->summary; ?></h5>
    </div>
    <div class="col-md-3 text-end">
        <h5>ID: <?php echo $ticket->id; ?></h5>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><i class="fa-solid fa-ticket"></i> Description</h6>
                <p><?php echo $ticket->description; ?></p>
            </div>
        </div>

        <h5 class="mt-2">Comments</h5>
        <?php
        foreach ($comments as $comment) {
        ?>
            <div class="card mt-2">
                <div class="card-body">
                    <?php
                    if ($comment->userid == $reporter->id) {
                    ?>
                        <h6 class="card-title"><i class="fa-regular fa-comment"></i> <?php echo $reporter->getFullname(); ?> commented at <?php echo system\Helper::arcConvertDateTime($comment->created); ?></h6>
                    <?php
                    } else if ($comment->userid != 0) {
                        $commenter = $assigned;
                        if ($comment->userid != $assigned) {
                            $commenter = User::getByID($comment->userid);
                        }
                    ?>
                        <h6 class="card-title"><i class="fa-regular fa-comment"></i> <?php echo $commenter->getFullname(); ?> commented at <?php echo system\Helper::arcConvertDateTime($comment->created); ?></h6>
                    <?php
                    } else {
                    ?>
                        <h6 class="card-title"><i class="fa-regular fa-comment"></i> SYSTEM commented at <?php echo system\Helper::arcConvertDateTime($comment->created); ?></h6>
                    <?php
                    }
                    ?>
                    <p><?php echo $comment->description; ?></p>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="card mt-2">
            <div class="card-body">
                <h6 class="card-title"><i class="fa-solid fa-comment-dots"></i> Respond</h6>
                <form id="commentForm">
                    <input id="ticketid" type="hidden" value="<?php echo $ticket->id; ?>" />
                    <textarea class="form-control" id="commentTXT" rows="6"></textarea>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Comment</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <?php
        if (system\Helper::arcIsUserAdmin()) {
        ?>
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><i class="fa-solid fa-user-astronaut"></i> Assigned to</h6>
                    <form id="assignedForm">
                        <input id="ticketid" type="hidden" value="<?php echo $ticket->id; ?>" />
                        <?php echo system\Helper::arcCreateHTMLSelect(
                            $admin_names,
                            $admin_ids,
                            "form-select",
                            $ticket->assignedto,
                            "assigned"
                        ); ?>

                        <div class="d-grid gap-2 mt-2">
                            <button type="submit" class="btn btn-primary">Set</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><i class="fa-solid fa-list-check"></i> Status</h6>
                    <form id="statusForm">
                        <input id="ticketid" type="hidden" value="<?php echo $ticket->id; ?>" />
                        <?php echo system\Helper::arcCreateHTMLSelect(
                            ArcServiceDeskTicket::getStatuses(),
                            ArcServiceDeskTicket::getStatuses(),
                            "form-select",
                            $ticket->status,
                            "status"
                        ); ?>

                        <div class="d-grid gap-2 mt-2">
                            <button type="submit" class="btn btn-primary">Set</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }

        if (system\Helper::arcIsUserAdmin()) {
        ?>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title"><i class="fa-solid fa-clock"></i> Created</h6>
                    <p class="text-center"><?php echo system\Helper::arcConvertDateTime($ticket->created); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title"><i class="fa-solid fa-user"></i> Reporter</h6>
                    <p class="text-center"><a href="/administration/users/<?php echo $reporter->id; ?>" target="_blank"><?php echo $reporter->getFullname(); ?></a></p>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</div>