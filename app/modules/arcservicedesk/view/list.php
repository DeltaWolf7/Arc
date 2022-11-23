<?php

$total = 0;
$inprogress = 0;
$opened = 0;
$closed = 0;
$user = system\Helper::arcGetUser();

if (system\Helper::arcIsUserAdmin()) {
    $total = ArcServiceDeskTicket::getCountTotal();
    $inprogress = ArcServiceDeskTicket::getCountByStatus("In Progress");
    $opened = ArcServiceDeskTicket::getCountByStatus("Opened");
    $closed = ArcServiceDeskTicket::getCountByStatus("Closed");
} else {
    $total = ArcServiceDeskTicket::getCountTotal($user->id);
    $inprogress = ArcServiceDeskTicket::getCountByStatus("In Progress", $user->id);
    $opened = ArcServiceDeskTicket::getCountByStatus("Opened", $user->id);
    $closed = ArcServiceDeskTicket::getCountByStatus("Closed", $user->id);
}

?>

<div class="card">
    <div class="card-body">
        <h3>Tickets</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 rounded bg-light-primary text-center">
                        <h1 class="fw-light text-primary"><?php echo $total; ?></h1>
                        <h6 class="text-primary">Total Tickets</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 rounded bg-light-warning text-center">
                        <h1 class="fw-light text-warning"><?php echo $inprogress; ?></h1>
                        <h6 class="text-warning">In Progress</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 rounded bg-light-success text-center">
                        <h1 class="fw-light text-success"><?php echo $opened; ?></h1>
                        <h6 class="text-success">Opened</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-hover">
                    <div class="p-2 rounded bg-light-danger text-center">
                        <h1 class="fw-light text-danger"><?php echo $closed; ?></h1>
                        <h6 class="text-danger">Closed</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end">
            <div class="row">
                <div class="col-md-3">
                    <form id="statusForm">
                    <div class="input-group mb-3">
                        <?php echo system\Helper::arcCreateHTMLSelect(
                            ArcServiceDeskTicket::getStatuses(),
                            ArcServiceDeskTicket::getStatuses(),
                            "form-select",
                            "",
                            "status"
                        ); ?>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Go</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <?php
                    if (system\Helper::arcIsUserAdmin()) {
                    ?>
                        <form id="searchForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th>Reporter</th>
                    <th>Assigned</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tickets = [];
                if (system\Helper::arcIsUserAdmin()) {
                    if (!isset($_GET["status"])) {
                        $tickets = ArcServiceDeskTicket::getAllByOpen();
                    } else {
                        $tickets = ArcServiceDeskTicket::getAllByStatus($_GET["status"]); 
                    }
                } else {
                    if (!isset($_GET["status"])) {
                        $tickets = ArcServiceDeskTicket::getAllByOpen($user->id);
                    } else {
                        $tickets = ArcServiceDeskTicket::getAllByStatus($_GET["status"], $user->id); 
                    }
                }

                foreach ($tickets as $ticket) {
                    $assignedto = User::getByID($ticket->assignedto);
                    if ($assignedto->id == 0) {
                        $assignedto->firstname = "Unassigned";
                    }

                    $reporter = User::getByID($ticket->userid);
                    if ($reporter->id == 0) {
                        $reporter->firstname = "Unassigned";
                    }
                ?>
                    <tr>
                        <td><?php echo $ticket->id; ?></td>
                        <td><?php echo system\Helper::arcConvertDateTime($ticket->created); ?></td>
                        <td><a href="<?php echo "view/" . $ticket->id; ?>"><?php echo $ticket->summary; ?></a></td>
                        <td><span class="badge text-bg-secondary"><?php echo $ticket->status; ?></span></td>
                        <td><?php echo $reporter->getFullname(); ?></td>
                        <td><?php echo $assignedto->getFullname(); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>