<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $user = new User();
    $user->delete($_POST["id"]);
}