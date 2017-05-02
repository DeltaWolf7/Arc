<?php

if (system\Helper::arcIsAjaxRequest()) {
    $category = new BlogCategory();
        $category->getByID($_POST["id"]);
        system\Helper::arcReturnJSON(["name" => $category->name, "seourl" => $category->seourl]);
}