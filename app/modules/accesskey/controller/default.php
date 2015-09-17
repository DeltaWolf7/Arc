<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (isset($_POST["key"])) {
        $user = AccessKey::getUserByKey(strtoupper($_POST["key"]));
        if ($user != null) {
            if ($user->enabled) {
                system\Helper::arcSetUser($user);
                system\Helper::arcAddMessage("success", "Access key found");
            } else {
                system\Helper::arcAddMessage("danger", "Account disabled");
            }
        } else {
            system\Helper::arcAddMessage("danger", "Invalid access key");
        }
    }
}
