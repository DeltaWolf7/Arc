<?php

$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());

$imagePath = system\Helper::arcGetPath() . "assets/products/";
$categories = [];
$products = [];

if (count($uri) > 1) {
    $catData = explode("-", $uri[count($uri) - 1]);
    $categories = ArcEcomCategory::getAllCategoriesByParentID($catData[0]);
    if (count($categories) == 0) {
        $products = ArcEcomProduct::getAllByCategoryID($catData[0]);
        $categories = [];
    }
    $cat = ArcEcomCategory::getByID($catData[0]);
    system\Helper::arcAddHeader("title", $cat->name);
} else {
    $categories = ArcEcomCategory::getAllCategoriesByParentID();
}
    