<?php

    $sitemap = file_get_contents(system\Helper::arcGetPath(true) . "sitemap.txt");
    echo "<br /><br />Adding Catgeories</br >";
    $categories = ArcEcomCategory::getAll();
    foreach ($categories as $category) {
        $sitemap .= system\Helper::arcGetPath() . "categories/" . $category->getSEOUrl() . PHP_EOL;
        echo system\Helper::arcGetPath() . "categories/" . $category->getSEOUrl() . "<br />";
    }

    file_put_contents(system\Helper::arcGetPath(true) . "sitemap.txt", $sitemap);
    echo "<br />Complete adding categories.";
?>