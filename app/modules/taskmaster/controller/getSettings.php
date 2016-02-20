<?php

if (system\Helper::arcIsAjaxRequest()) {
    $emailSettings = SystemSetting::getByKey("TM_SENDTOEMAILS");
    system\Helper::arcReturnJSON(["emails" => $emailSettings->value]);
}