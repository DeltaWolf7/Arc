<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "users") {
        $table = "<table class=\"table table-striped\">"
                . "<tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>&nbsp;</th></tr>";
        $users = User::getAllUsers();
        foreach ($users as $user) {
            $table .= "<tr><td>{$user->firstname}</td><td>{$user->lastname}</td><td>{$user->email}</td><td class=\"text-right\"><a onclick=\"editUser({$user->id});\" class=\"btn btn-default btn-sm\"><span class=\"fa fa-edit\"></span>&nbsp;Edit</a>&nbsp;<a onclick=\"removeUser({$user->id});\" class=\"btn btn-default btn-sm\"><span class=\"fa fa-remove\"></span>&nbsp;Remove</a></td></tr>";
        }
        $table .= "</table>";
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "groups") {
        $table = "<table class=\"table table-striped\">"
                . "<tr><th>Name</th><th>Description</th><th>&nbsp;</th></tr>";
        $groups = UserGroup::getAllGroups();
        foreach ($groups as $group) {
            $table .= "<tr><td>{$group->name}</td><td>{$group->description}</td><td class=\"text-right\"><a onclick=\"editGroup({$group->id});\" class=\"btn btn-default btn-sm\"><span class=\"fa fa-edit\"></span>&nbsp;Edit</a>&nbsp;<a onclick=\"removeGroup({$group->id});\" class=\"btn btn-default btn-sm\"><span class=\"fa fa-remove\"></span>&nbsp;Remove</a></td></tr>";
        }
        $table .= "</table>";
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "remove") {
        $user = new User();
        $user->delete($_POST["id"]);
    } elseif ($_POST["action"] == "user") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $data = "<label for=\"groups2\">In Groups</label><select id=\"groups2\" class=\"form-control\" size=\"10\">";
        foreach ($user->getGroups() as $group) {
            $data .= "<option value=\"" . $group->name . "\">" . $group->name . "</option>";
        }
        $data .= "</select>";
        echo json_encode(["firstname" => $user->firstname, "lastname" => $user->lastname, "email" => $user->email, "group" => $data]);
    } elseif ($_POST["action"] == "saveuser") {
        $user = new User();
        $user->getByID($_POST["id"]);

        // password settings
        if (!empty($_POST["password"])) {
            if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["retype"])) {
                $user->setPassword($_POST["password"]);
            } else {
                echo json_encode(["status" => "danger", "data" => "Password and retyped password do not match"]);
                return;
            }
        }

        $user->firstname = ucwords($_POST["firstname"]);
        $user->lastname = ucwords($_POST["lastname"]);
        $user->email = strtolower($_POST["email"]);
        $user->update();

        echo json_encode(["status" => "success", "data" => "Changes saved"]);
    } elseif ($_POST["action"] == "removegroup") {
        $group = new UserGroup();
        $group->delete($_POST["id"]);
        $group->getByID($_POST["id"]);
        if ($group->id != 0) {
            echo json_encode(["status" => "danger", "data" => "System groups cannot be removed"]);
            return;
        }
        echo json_encode(["status" => "success", "data" => "Group removed"]);
    } elseif ($_POST["action"] == "savegroup") {
        $group = new UserGroup();
        $group->getByID($_POST["id"]);
        $group->name = ucwords($_POST["name"]);
        $group->description = $_POST["description"];
        $group->update();
        echo json_encode(["status" => "success", "data" => "Group saved"]);
    } elseif ($_POST["action"] == "group") {
        $group = new UserGroup();
        $group->getByID($_POST["id"]);
        echo json_encode(["name" => $group->name, "description" => $group->description]);
    } elseif ($_POST["action"] == "addgroup") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $user->addToGroup($_POST["group"]);        
        echo json_encode(["status" => "success", "data" => "User added to group"]);
    } elseif ($_POST["action"] == "removefromgroup") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $user->removeFromGroup($_POST["group"]);        
        echo json_encode(["status" => "success", "data" => "User removed from group"]);
    }
}