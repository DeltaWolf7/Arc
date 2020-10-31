<?php

$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());

if (count($uri) > 1) {
    $productdata = explode("-", $uri[count($uri) - 1]);

    $product = ArcEcomProduct::GetByID($productdata[0]);
    system\Helper::arcAddHeader("title", $product->name);

    $path = system\Helper::arcGetPath() . "assets/products/";
    $images = ArcEcomImage::getAllByProductIDAndType($product->id, "IMAGE");
    if (count($images) == 0) {
        $images = []; 
        $images[] = ArcEcomImage::getByProductIDAndType($product->id, "THUMB");
    }

    $sizes = ArcEcomAttribute::getAllByProductIDAndName($product->id, "SIZE");
    $colours = ArcEcomAttribute::getAllByProductIDAndName($product->id, "COLOUR");
    $batteries = ArcEcomAttribute::getAllByProductIDAndName($product->id, "BATTERIES");
    $flavours = ArcEcomAttribute::getAllByProductIDAndName($product->id, "FLAVOUR");
}
?>