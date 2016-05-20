<?php
// New tickets
$tickets = ArcDeskTicket::getByStatus("1");
?>

<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-10">
            <?php
            foreach ($tickets as $ticket) {
                $company = new ArcDeskCompany();
                $company->getByID($ticket->companyid);
                $assigned = "Not Assigned";
                if ($ticket->agentid != 0) {
                    $user = new User();
                    $user->getByID($ticket->agentid);
                    $assigned = $user->getFullname();
                }
                $requester = new User();
                $requester->getByID($ticket->requesterid);
                $status = new ArcDeskStatus();
                $status->getByID($ticket->statusid);
                
                $priority = new ArcDeskPriority();
                $priority->getByID($ticket->priorityid);

                echo "<div class=\"row ticket\"><div class=\"col-md-1 ticket-green\"><div class=\"checkbox\"><input type=\"checkbox\"></div></div>"
                . "<div class=\"col-md-8\"><a><strong>{$ticket->subject}</strong></a> <small>#{$ticket->type}-{$ticket->reference}</small>"
                . "<p><small>From: <a>{$requester->getFullname()}</a> (<a>{$company->name}</a>)</small></p>"
                . "<p><small>Opened: {$ticket->created}</small></p></div>"
                . "<div class=\"col-md-1\">";
                switch ($ticket->source) {
                    case "Phone":
                        echo "<i class=\"fa fa-phone fa-4x ticket-icon\"></i>";
                        break;
                    case "Email":
                        echo "<i class=\"fa fa-envelope fa-4x ticket-icon\"></i>";
                        break;
                    case "Portal":
                        echo "<i class=\"fa fa-globe fa-4x ticket-icon\"></i>";
                        break;
                }
                        
                echo "</div><div class=\"col-md-2\"><small>Agent: {$assigned}<br/>Status: {$status->name}<br />Priority: {$priority->name}</small></div></div>";
            }
            ?>
    </div>
</div>