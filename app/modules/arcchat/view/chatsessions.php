<table class="table table-striped">
<tr><th>Event</th><th>Guest</th><th>Agent(s)</th><th>Status</th><th></th></tr>
<?php

    $sessions = ChatSession::getSessionsByStatus();
    foreach ($sessions as $session) {
        echo "<tr><td>"
        . system\Helper::arcConvertDatetime($session->event)
        . "</td><td>";

        $user = User::getByID($session->guestid);

        echo $user->getFullname()
         . "</td><td>";
         
         $agents = $session->getAgents();
         $names = [];
         foreach ($agents as $agent) {
           $user = User::getByID($agent);
           $names[] = $user->getFullname();
         }
         echo implode(", ", $names);

         echo "</td><td>"
         . $session->status
         . "</td><td>"
         . "<button class=\"btn btn-success\" onclick=\"joinChat(" . $session->id . ")\">Join</button>"
         . "<button class=\"btn btn-success\" onclick=\"endChat(" . $session->id . ")\">End</button>"
         . "</td></tr>";
    }

?>

</table>


<div class="modal fade" id="chatDialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Chat Session</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            <div class="card" style="width: 100%;">
            <div class="card-header card-primary">
                <h4 class="card-title">Chat</h4>
            </div>
            <div id="chatSession" class="card-block">
                
                            
                        
            </div>
            <div class="card-footer text-muted">
            <div class="input-group">
                            <input type="text" id="message" class="form-control" placeholder="Enter your message here..">
                            <span class="input-group-btn">
                                <button id="chatSend" class="btn btn-default" type="button">Send</button>
                            </span>
                            </div>
            </div>
            </div>


      </div>
      <div class="modal-footer">
        <button type="button" id="closeChat" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>