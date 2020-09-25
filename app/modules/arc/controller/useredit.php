<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    if ($user->id == 0) {
        $user = new User();
    }
    $userGroups = UserGroup::getAllGroups();
    $usercrm = ArcCRMUser::getByUserID($user->id);
    if ($usercrm->id == 0) {
        $usercrm = new ArcCRMUser();
        $usercrm->userid = $user->id;
    }

    $html = "<form>"
        . "<div class=\"row\">"
            . "<div class=\"col-md-12 text-muted text-right text-small\">"
            . "<span class=\"badge badge-info\">Created: " . system\Helper::arcConvertDate($user->created) . "</span>&nbsp;"
            . "<span class=\"badge badge-primary\">ID: " . $user->id . "</span>&nbsp;"
            . "<span class=\"badge badge-";
            if ($usercrm->id == 0) { $html .= "danger"; } else { $html .= "success"; }
    $html .= "\">CRMID: ";
            if ($usercrm->id == 0) { $html .= "No record"; } else { $html .= $usercrm->id; }
    $html .= "</span>"
            . "</div>"
        . "</div>"
        . "<div class=\"row mt-3\">"
            . "<div class=\"col-md-6\">"
                . "<div class=\"form-group\">"
                    . "<label for=\"firstname\">Firstname</label>"
                    . "<input type=\"text\" class=\"form-control\" id=\"firstname\" placeholder=\"Firstname\" value=\"" . $user->firstname . "\">"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"lastname\">Lastname</label>"
                    . "<input type=\"text\" class=\"form-control\" id=\"lastname\" placeholder=\"Lastname\" value=\"" . $user->lastname . "\">"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"email\">Email</label>"
                    . "<input type=\"text\" class=\"form-control\" id=\"email\" placeholder=\"Email\" value=\"" . $user->email . "\">"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"avGroups\">Available Groups</label>"
                    . "<select id=\"avGroups\" class=\"form-control\" size=\"5\" ondblclick=\"addUserToGroup(" . $user->id . ")\">";

                    foreach ($userGroups as $group) { 
                        if ($user->inGroup($group->name) != true) {
                            $html .= "<option value=\"" . $group->name . "\">" . $group->name . "</option>";
                        }
                    }

    $html           .= "</select>"
                . "</div>"
            . "</div>"
            . "<div class=\"col-md-6\">"
                . "<div class=\"form-group\">"
                    . "<label for=\"password\">Password (Leave blank to keep unchanged)</label>"
                    . "<input type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Password\" autocomplete=\"off\">"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"retype\">Retype</label>"
                    . "<input type=\"password\" class=\"form-control\" id=\"retype\" placeholder=\"Retype\" autocomplete=\"off\">"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"enabled\">Account Enabled</label>"
                    . "<select id=\"enabled\" class=\"form-control\">"
                        . "<option value=\"1\" ";
                            
                        if($user->enabled == "1") $html .= "selected";
                        
                        $html .= ">Yes</option>"
                        . "<option value=\"0\" ";
                        
                        if($user->enabled == "0") $html .= "selected";
                        
                        $html .= ">No</option>"
                    . "</select>"
                . "</div>"
                . "<div class=\"form-group\">"
                    . "<label for=\"inGroups\">In Groups</label>"
                    . "<select id=\"inGroups\" class=\"form-control\" size=\"5\" ondblclick=\"removeUserFromGroup(" . $user->id . ")\">";

                    foreach ($userGroups as $group) { 
                        if ($user->inGroup($group->name) == true) {
                            $html .= "<option value=\"" . $group->name . "\">" . $group->name . "</option>";
                        }
                    }

        $html           .= "</select>"
                . "</div>"
            . "</div>"
        . "</div>";

        $html .= "<div class=\"text-right\">"
                    . "<button class=\"btn btn-primary\" onclick=\"closeUser()\">Close</button>&nbsp;"
                    . "<button class=\"btn btn-success\" onclick=\"saveUser(" . $user->id . ")\">Save</button>"
                . "</div>";

        $html .= "<div class=\"row mt-3\"><div class=\"col-md-12 border-top border-primary\"></div></div>";

        $html .= "<div class=\"row mt-3\">"
                    . "<div class=\"col-md-6\">"
                        . "<div class=\"form-group\">"
                            . "<label for=\"company\">Company</label>"
                            . "<input maxlength=\"50\" type=\"text\" class=\"form-control\" id=\"company\" placeholder=\"Company\" value=\"" . $usercrm->company . "\">"
                        . "</div>"
                        . "<div class=\"form-group\">"
                            . "<label for=\"addresslines\">Address Lines</label>"
                            . "<textarea class=\"form-control\" id=\"addresslines\" rows=\"5\">" . $usercrm->addresslines . "</textarea>"
                        . "</div>"
                        . "<div class=\"form-group\">"
                            . "<label for=\"county\">County</label>"                       
                            . "<input maxlength=\"50\" type=\"text\" class=\"form-control\" id=\"county\" placeholder=\"County\" value=\"" . $usercrm->county . "\">"
                        . "</div>"
                        . "<div class=\"form-group\">"
                            . "<label for=\"postcode\">Postcode</label>"
                            . "<input maxlength=\"10\" type=\"text\" class=\"form-control\" id=\"postcode\" placeholder=\"Postcode\" value=\"" . $usercrm->postcode . "\">"
                        . "</div>"
                        . "<div class=\"form-group\">"
                            . "<label for=\"country\">Country</label>";

                        $html .= system\Helper::arcCreateHTMLSelect(ArcCountries::getArray(), ArcCountries::getArray(), "form-control", $usercrm->country, "country");

                        $html .= "</div>"
                    . "</div>"
                    . "<div class=\"col-md-6\">"
                        . "<div class=\"form-group\">"
                            . "<label for=\"source\">Source</label>";

                        $html .= system\Helper::arcCreateHTMLSelect(["Direct", "Email", "Google", "Phone", "Word of Mouth", "Advert", "Other"], 
                            ["Direct", "Email", "Google", "Phone", "Word", "AD", "Other"], "form-control", $usercrm->source, "source");

                        $html .= "</div>"  
                        . "<div class=\"form-group\">"
                            . "<label for=\"phone\">Phone</label>"
                            . "<input maxlength=\"20\" type=\"text\" class=\"form-control\" id=\"phone\" placeholder=\"Phone\" value=\"" . $usercrm->phone . "\">"
                        . "</div>"
                        . "<div class=\"form-group\">"
                            . "<label for=\"notes\">Notes</label>"
                            . "<textarea class=\"form-control\" id=\"notes\" rows=\"12\">" . $usercrm->notes . "</textarea>"
                        . "</div>"
                    . "</div>"
                . "</div>";

        $html .= "<div class=\"text-right\">"
                . "<button class=\"btn btn-primary\" onclick=\"closeUser()\">Close</button>&nbsp;"
                . "<button class=\"btn btn-success\" onclick=\"saveUser(" . $user->id . ")\">Save</button>"
            . "</div>";
                
        $html .= "<div class=\"row mt-3\"><div class=\"col-md-12 border-top border-primary\"></div></div>";

        $html .= "<div class=\"row\"><div class=\"col-md-12 text-right\"><button class=\"btn btn-success btn-sm mt-2\" onclick=\"editContact(0)\"><i class=\"fa fa-plus\"></i> Create</button></div></div>";

        $html .= "<div class=\"table-responsive mt-3\">"
                    . "<table class=\"table table-striped\">"
                        . "<thead>"
                            . "<tr><th>ID</th><th>Name</th><th>Title</th><th>Email</th><th>Phone</th><th>Action</th></tr>"
                        . "</thead>"
                        . "<tbody>";

        $crmcontacts = ArcCRMUserContact::getAllByUserID($user->id);
        foreach ($crmcontacts as $contact) {
            $html .= "<tr><td>" . $contact->id . "</td><td>" . $contact->name . "</td><td>"
                . $contact->title . "</td><td>" . $contact->email . "</td><td>" . $contact->phone . "</td>"
                . "<td style=\"width: 10px;\">"
                    . "<div class=\"btn-group\" role=\"group\">"
                        . "<button class=\"btn btn-primary btn-sm\" onclick=\"editContact(" . $contact->id . ")\"><i class=\"fa fa-pencil\"></i></button>"
                        . "<button style=\"width: 35px;\" class=\"btn btn-danger btn-sm\" onclick=\"removeContact(" . $contact->id . ")\"><i class=\"fa fa-remove\"></i></button>"
                    . "</div>"
                . "</td></tr>";
        }


        $html .=          "</tbody>"
                    . "</table>"
                . "</div>";

        $html .= "<div class=\"text-right\">"
                . "<button class=\"btn btn-primary\" onclick=\"closeUser()\">Close</button>&nbsp;"
                . "<button class=\"btn btn-success\" onclick=\"saveUser(" . $user->id . ")\">Save</button>"
            . "</div>";

        $html .= "</form>";

    system\Helper::arcReturnJSON(["html" => $html]);
}