<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "users") {
        $table = "<table class=\"table table-hover table-condensed\">"
                . "<thead><tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Status</th><th class=\"text-right\"><a onclick=\"editUser(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i>&nbsp;New User</a></th></tr></thead>"
                . "<tbody>";
        $users = User::getAllUsers();
        foreach ($users as $user) {
            $table .= "<tr><td>{$user->firstname}</td><td>{$user->lastname}</td><td>{$user->email}</td><td>";
            if ($user->enabled) {
                    $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
                } else {
                    $table .= "<div class=\"label label-danger\"><i class=\"fa fa-close\"></i></div>";
                }
            $table .= "</td><td class=\"text-right\"><a onclick=\"editUser({$user->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-edit\"></i>&nbsp;Edit</a>&nbsp;<a onclick=\"removeUser({$user->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-remove\"></i>&nbsp;Remove</a></td></tr>";
        }
        $table .= "</tbody></table>";
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "groups") {
        $table = "<table class=\"table table-hover table-condensed\">"
                . "<thead><tr><th>Name</th><th>Description</th><th class=\"text-right\"><a onclick=\"editGroup(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i>&nbsp;New Group</a></th></tr></thead><tbody>";
        $groups = UserGroup::getAllGroups();
        foreach ($groups as $group) {
            $table .= "<tr><td>{$group->name}</td><td>{$group->description}</td><td class=\"text-right\"><a onclick=\"editGroup({$group->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-edit\"></i>&nbsp;Edit</a>&nbsp;<a onclick=\"removeGroup({$group->id});\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-remove\"></i>&nbsp;Remove</a></td></tr>";
        }
        $table .= "</tbody></table>";
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "remove") {
        $user = new User();
        $user->delete($_POST["id"]);
    } elseif ($_POST["action"] == "user") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $data = "<label for=\"groups2\">In Groups</label><select id=\"groups2\" class=\"form-control\" size=\"16\">";
        foreach ($user->getGroups() as $group) {
            $data .= "<option value=\"{$group->name}\">{$group->name}</option>";
        }
        $data .= "</select>";
        echo json_encode(["firstname" => $user->firstname, "lastname" => $user->lastname, "email" => $user->email, "group" => $data, "enabled" => boolval($user->enabled)]);
    } elseif ($_POST["action"] == "saveuser") {
        $user = new User();
        $user->getByID($_POST["id"]);
        // password settings
        if (!empty($_POST["password"])) {
            if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["retype"])) {
                $user->setPassword($_POST["password"]);
            } else {
                system\Helper::arcAddMessage("danger", "Password and retyped password do not match");
                return;
            }
        }
        $user->firstname = ucwords(strtolower($_POST["firstname"]));
        if (empty($_POST["firstname"])) {
            system\Helper::arcAddMessage("danger", "Firstname cannot be empty");
            return;
        }
        
        $user->lastname = ucwords(strtolower($_POST["lastname"]));
        if (empty($_POST["lastname"])) {
            system\Helper::arcAddMessage("danger", "Lastname cannot be empty");
            return;
        }
        
        $test = User::getByEmail($_POST["email"]);
        if ($user->id == 0 && $test->id != 0) {
            system\Helper::arcAddMessage("danger", "User already exists with this email address");
            return;
        }
        
        if ($user->id == 0 && empty($_POST["password"])) {
            system\Helper::arcAddMessage("danger", "New users must have a password");
            return;
        }
        
        if ($_POST["enabled"] == "true") {
            $user->enabled = 1;
        } else {
            $user->enabled = 0;
        }
     
        $user->email = strtolower($_POST["email"]);
        $user->update();
        system\Helper::arcAddMessage("success", "Changes saved");
    } elseif ($_POST["action"] == "removegroup") {
        $group = new UserGroup();
        $group->delete($_POST["id"]);
        $group->getByID($_POST["id"]);
        if ($group->id != 0) {
            system\Helper::arcAddMessage("danger", "System groups cannot be removed");
            return;
        }
        system\Helper::arcAddMessage("success", "Group removed");
    } elseif ($_POST["action"] == "savegroup") {
        $group = new UserGroup();
        $group->getByID($_POST["id"]);
        $group->name = ucwords(strtolower($_POST["name"]));
        if (empty($_POST["name"])) {
            system\Helper::arcAddMessage("danger", "Group name cannot be empty");
            return;
        }
        $group->description = $_POST["description"];
        $group->update();
        system\Helper::arcAddMessage("success", "Group saved");
    } elseif ($_POST["action"] == "group") {
        $group = new UserGroup();
        $group->getByID($_POST["id"]);
        echo json_encode(["name" => $group->name, "description" => $group->description]);
    } elseif ($_POST["action"] == "addgroup") {
        $user = new User();
        $user->getByID($_POST["id"]);
        
        if ($user->id == 0) {
            system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
            return;
        }
        
        $user->addToGroup($_POST["group"]);  
        system\Helper::arcAddMessage("success", "User added to group");
    } elseif ($_POST["action"] == "removefromgroup") {
        $user = new User();
        $user->getByID($_POST["id"]);
        
        if ($user->id == 0) {
            system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
            return;
        }
        
        $user->removeFromGroup($_POST["group"]);  
        system\Helper::arcAddMessage("success", "User removed from group");
    }
}