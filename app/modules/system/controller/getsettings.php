<?php

if (system\Helper::arcIsAjaxRequest()) {
    $html = system\Helper::arcGetSettingModules();
    system\Helper::arcReturnJSON(["html" => $html]);
}          