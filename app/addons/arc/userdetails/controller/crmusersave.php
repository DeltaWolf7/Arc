<?php

if (system\Helper::arcIsAjaxRequest()) {
    $usercrm = CRMUser::getByID($_POST["crmuserid"]);
    if ($usercrm->id == 0) {
        $usercrm = new CRMUser();
        $usercrm->userid = $_POST["userid"];
    }

    $usercrm->phone = $_POST["phone"];
    $usercrm->update();

    system\Helper::arcAddMessage("success", "CRM User details updated");
    system\Helper::arcReturnJSON();
}