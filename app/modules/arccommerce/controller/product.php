<?php

$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());

if (count($uri) > 1) {
    $productdata = explode("-", $uri[count($uri) - 1]);

    $product = ArcEcomProduct::GetByID($productdata[0]);
    if ($product->id > 0) {
        system\Helper::arcAddHeader("title", $product->name);
        system\Helper::arcAddHeader("description", $product->description);

        $path = system\Helper::arcGetPath() . "assets/products/";
        $images = ArcEcomImage::getAllByProductIDAndType($product->id, "IMAGE");
        if (count($images) == 0) {
            $images = []; 
            $images[] = ArcEcomImage::getByProductIDAndType($product->id, "THUMB");
        }

        $options = ArcEcomAttribute::getAllByProductID($product->id);
        $selectable = [];
        $features = "";
        foreach ($options as $option) {
            $type= ArcEcomAttributeType::getByID($option->typeid);
            if ($type->isoption) {
                $selectable[$type->name][] = ["value" => $option->value, "stock" => $option->stock, "priceadjust" => $option->priceadjust, "id" => $option->id];
            } else {
                $features .= "<tr><td>" . ucwords(strtolower($type->name)) . "</td><td>{$option->value}</td></tr>". PHP_EOL;
            }
        }
    }
}
?>