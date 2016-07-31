<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = new User();
    $user->delete($_POST["id"]);
}