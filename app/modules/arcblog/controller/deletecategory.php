<?php

if (system\Helper::arcIsAjaxRequest()) {
    $category = new BlogCategory();
        $category->delete($_POST["id"]);
        system\Helper::arcAddMessage("success", "Blog category deleted");
}