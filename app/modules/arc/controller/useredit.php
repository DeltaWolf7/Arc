<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $userGroups = UserGroup::getAllGroups();

    $html = "<form><div class=\"row\">"
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
                . "</div></form>";

    system\Helper::arcReturnJSON(["html" => $html]);
}