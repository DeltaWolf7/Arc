<?php

if (system\Helper::arcIsAjaxRequest() == true) {
            $email = Email::getByID($_POST["id"]);
            if ($email->protected == 0) {
                $email->delete();
                system\Helper::arcAddMessage("success", "Email deleted");
            } else {
                system\Helper::arcAddMessage("danger", "System email cannot be deleted");
            }
            system\Helper::arcReturnJSON();
}