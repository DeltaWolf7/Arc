<?php

if (system\Helper::arcIsAjaxRequest()) {

    $category = new ForumCategory();
    $category->name = $_POST["name"];
    $category->description = $_POST["description"];
    $category->parentid = $_POST["parentid"];
    $category->update();
    
    system\Helper::arcReturnJSON();
}