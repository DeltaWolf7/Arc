<?php

if (system\Helper::arcIsAjaxRequest()) {
    $emailSettings = SystemSetting::getByKey("TM_SENDTOEMAILS");
    $emailSettings->value = $_POST["emails"];
    $emailSettings->update();
    
    system\Helper::arcAddMessage("success", "Settings saved");
}