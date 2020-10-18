<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = [];
    
    if (!isset($_POST["search"]) || $_POST["search"] == "") {
        $users = User::getAllUsers();
    } else {
        $users = User::search($_POST["search"]);
    }

    $data = "ID,Firstname,Lastname,Email,Phone,Notes,Groups\n";
    foreach ($users as $user) {
        $crm = CRMUser::getByUserID($user->id);
        $groups = $user->getGroups();
        $grouplist = [];
        foreach ($groups as $group) {
            $grouplist[] = $group->name;
        }
        $grps = implode("|", $grouplist);
        $data .= $user->id . "," . $user->firstname . "," . $user->lastname . "," . $user->email . "," . $crm->phone . ",\"" . $crm->notes . "\"," . $grps . "\n";
    }    

    system\Helper::arcReturnJSON(["data" => $data]);
}