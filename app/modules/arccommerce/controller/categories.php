<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/search.js");
$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());

$imagePath = system\Helper::arcGetPath() . "assets/products/";
$catImagePath = system\Helper::arcGetPath() . "assets/categories/";
$categories = [];
$products = [];

// sort
$sort = "az";
$sortBy = "name";
$sortOrd = "ASC";
if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
}

switch ($sort) {
    case "az":
        $sortBy = "name";
        $sortOrd = "ASC"; 
        break;
    case "za":
        $sortBy = "name";
        $sortOrd = "DESC"; 
        break;
    case "lh":
        $sortBy = "price";
        $sortOrd = "ASC"; 
        break;
    case "hl":
        $sortBy = "price";
        $sortOrd = "DESC"; 
        break;
}


    if (count($uri) > 1) {
        $catData = explode("-", $uri[count($uri) - 1]);
        $categories = ArcEcomCategory::getAllCategoriesByParentID($catData[0]);
        if (count($categories) == 0) {
            $products = ArcEcomProduct::getAllByCategoryID($catData[0], $sortBy, $sortOrd);
            $categories = [];
        }
        $cat = ArcEcomCategory::getByID($catData[0]);
        system\Helper::arcAddHeader("title", $cat->name);
        system\Helper::arcAddHeader("description", $cat->name);
        $bread = CreateBreadCrumb("<li class=\"breadcrumb-item\"><a href=\"/categories\">Home</a></li>", $cat);
    } else {
        $categories = ArcEcomCategory::getAllCategoriesByParentID();
        $bread = "<li class=\"breadcrumb-item\"><a href=\"/categories\">Home</a></li>";
    }


function CreateBreadCrumb($breadcrumb, $category) {
    if ($category->parentid != 0) {
        $parent = ArcEcomCategory::GetByID($category->parentid);
        $breadcrumb = CreateBreadCrumb($breadcrumb, $parent);
    } 
    return $breadcrumb . PHP_EOL . "<li class=\"breadcrumb-item\"><a href=\"/categories/" . $category->getSEOUrl() . "\">" . $category->name . "</a></li>";
}