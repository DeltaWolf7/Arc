<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = new User();
    $user->getByID($_POST["id"]);

    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
        return;
    }

    $user->addToGroup($_POST["group"]);
    system\Helper::arcAddMessage("success", "User added to group");
}