<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);

    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
        return;
    }

    $user->removeFromGroup($_POST["group"]);
    system\Helper::arcAddMessage("success", "User removed from group");
}
