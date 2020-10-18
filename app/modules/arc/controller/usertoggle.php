<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    if ($user->enabled == 1) {
        $user->enabled = 0;
    } else {
        $user->enabled = 1;
    }
    $user->update();

    system\Helper::arcAddMessage("success", "Account toggled");
    system\Helper::arcReturnJSON();
}