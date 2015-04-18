<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "send") {
        $user = new User();
        $user->getByID($_POST["id"]);
        system\Helper::arcSendMail("office@mrfelevenplustuition.co.uk", "Game Submission: {$user->getFullname()}", $_POST["data"]);
        system\Helper::arcAddMessage("Success", "Game submitted, thank you.");
    }
}
