<?php

if (system\Helper::arcIsAjaxRequest()) {

    $category = ForumCategory::getByID($_POST["categoryid"]);
    $category->allowpost = $_POST["allow"];
    $category->update();

    system\Helper::arcReturnJSON([]);

}