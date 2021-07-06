<?php

    Log::createLog("success", "CRON", "Creating Google products feeds XML.");
    $products = ArcEcomProduct::getAll();
    Log::createLog("success", "CRON", "XML feed has " + count($products) . " products.");
    $path = system\Helper::arcGetPath() . "assets/products/";

    $productFeed = '<?xml version="1.0"?><rss version="2.0" xmlns:g="http://base.google.com/ns/1.0"><channel>';
    $productFeed .= '<title>ClassyBunnies.co.uk</title>';
    $productFeed .= '<link>' . system\Helper::arcGetPath() . '</link>';
    $productFeed .= '<description>Classy Bunnies is the UK\'s based, popular online store for buying adult toys discreetly online.</description>';

    foreach ($products as $product) {
        $images = ArcEcomImage::getAllByProductIDAndType($product->id, "IMAGE");
        if (count($images) == 0) {
            $images = []; 
            $images[] = ArcEcomImage::getByProductIDAndType($product->id, "THUMB");
        }

        $stock = "in stock";
        if ($product->stock == 0) {
            $stock = "out of stock";
        }

        $brand = ArcEcomBrand::getByID($product->brandid);


        
        $productFeed .= '<item>';
        $productFeed .= '<g:id>' . $product->id . '</g:id>';
        $productFeed .= '<g:title>' . $product->name . '</g:title>';
        $productFeed .= '<g:description>' . $product->description . '</g:description>';
        $productFeed .= '<g:link>' . system\Helper::arcGetPath() . 'products/' . $product->getSEOUrl() . '</g:link>';
        $productFeed .= '<g:image_link>' . $path .  $images[0]->filename . '</g:image_link>';
        $productFeed .= '<g:condition>new</g:condition>';
        $productFeed .= '<g:availability>' . $stock . '</g:availability>';
        $productFeed .= '<g:price>' . $product->price . ' GBP</g:price>';
        $productFeed .= '<g:brand>' . $brand->name . '</g:brand>';
        $productFeed .= '<g:mpn>' . $product->model . '</g:mpn>';
        $productFeed .= '<g:google_product_category>Mature > Erotic > Sex Toys</g:google_product_category>';
        $productFeed .= '<g:shipping>';
        $productFeed .= '<g:country>UK</g:country>';
        $productFeed .= '<g:service>Royal Mail Tracked 48hrs</g:service>';
        $productFeed .= '<g:price>3.66 GBP</g:price>';
        $productFeed .= '</g:shipping>';
        $productFeed .= '</item>';

        echo "Added '" . $product->name . "' to map.<br />";
    }

    $productFeed .= '</channel></rss>';

    $map = fopen(system\Helper::arcGetPath(true) . "productsmap.xml", "w") or die("Unable to open file!");
    fwrite($map, $productFeed);
    fclose($map);  
    Log::createLog("success", "CRON", "Product feed XML complete.");