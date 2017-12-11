<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);

    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
        system\Helper::arcReturnJSON([]);
        return;
    }

    if ($user->inGroup($_POST["group"])) {
        $user->removeFromGroup($_POST["group"]);
        system\Helper::arcAddMessage("success", "User removed from {$_POST["group"]}");
    } else {
        $user->addToGroup($_POST["group"]);
        system\Helper::arcAddMessage("success", "User added to {$_POST["group"]}");
    }
    
    system\Helper::arcReturnJSON();
}