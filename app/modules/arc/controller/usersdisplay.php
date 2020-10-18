<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
   
    $table = "<h3>Displaying " . count($users) . " user details</h3>";
    foreach ($users as $user) {
        $crmuser = CRMUser::getByUserID($user->id);
        $table .= "<div class=\"row\"><div class=\"col-md-12\"><table class=\"table table-striped table-sm\">";  
        $table .= "<tr><td><strong>ID</strong></td><td>" . $user->id . "</td></tr>";
        $table .= "<tr><td><strong>Firstname</strong></td><td>" . $user->firstname . "</td></tr>";
        $table .= "<tr><td><strong>Lastname</strong></td><td>" . $user->lastname . "</td></tr>";
        $table .= "<tr><td><strong>Email</strong></td><td>" . $user->email . "</td></tr>";
        $table .= "<tr><td><strong>Enabled</strong></td><td>" . $user->enabled . "</td></tr>";
        $table .= "<tr><td><strong>Created</strong></td><td>" . system\Helper::arcConvertDateTime($user->created) . "</td></tr>";
        $table .= "<tr><td><strong>Groups</strong></td><td>";
        foreach ($user->getGroups() as $group) {
            $table .= $group->name . "<br />";
        }
        $table .= "<tr><td><strong>CRM ID</strong></td><td>" . $crmuser->id . "</td></tr>";
        $table .= "<tr><td><strong>Company</strong></td><td>" . $crmuser->company . "</td></tr>";
        $table .= "<tr><td><strongSource</strong></td><td>" . $crmuser->source . "</td></tr>";
        $table .= "<tr><td><strong>Address Lines</strong></td><td>" . $crmuser->addresslines . "</td></tr>";
        $table .= "<tr><td><strong>County</strong></td><td>" . $crmuser->county . "</td></tr>";
        $table .= "<tr><td><strong>Postcode</strong></td><td>" . $crmuser->postcode . "</td></tr>";
        $table .= "<tr><td><strong>Country</strong></td><td>" . $crmuser->country . "</td></tr>";
        $table .= "<tr><td><strong>Notes</strong></td><td>";
        foreach (explode("\n", $crmuser->notes) as $note) {
            $table .= $note . "<br />";
        }        
        $table .= "</td></tr>";
        $crmlinks = CRMUserLink::getAllByUserID($user->id);
        $table .= "<tr><td><strong>Account Links</strong></td><td>" . count($crmlinks) . "</td></tr>";  
        $crmcontacts = CRMUserContact::getAllByUserID($user->id);
        $table .= "<tr><td><strong>Account Contacts</strong></td><td>" . count($crmcontacts) . "</td></tr>";  
        foreach ($crmcontacts as $link) {
            $table .= "<tr class=\"table-dark\"><td colspan=\"2\">";
            $table .= "<table class=\"table table-striped\">";
            $table .= "<tr><th>ID</th><th>Name</th><th>Title</th><th>Email</th><th>Phone</th></tr>";
            $table .= "<tr><td>" . $link->id . "</td><td>" . $link->name . "</td><td>" . $link->title . "</td><td>" . $link->email . "</td><td>" . $link->phone . "</td></tr>";
            $table .= "</table>";
            $table .= "</td></tr>";
        }
        $table .= "<tr class=\"table-dark\"><td colspan=\"2\"><hr /></td></tr>";
        $table .= "</table></div></div>";
    }
    system\Helper::arcReturnJSON(["html" => $table]);
}