<?php

if (system\Helper::arcIsAjaxRequest()) {
    $category = BlogCategory::getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["name" => $category->name, "seourl" => $category->seourl]);
}
