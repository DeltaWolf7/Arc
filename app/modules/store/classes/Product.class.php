<?php

/*
 * The MIT License
 *
 * Copyright 2014 craig.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of Product
 *
 * @author craig
 */
class Product extends DataProvider {
    
    public $name;
    public $description;
    public $sku;
    public $model;
    public $seourl;
    public $metakeywords;
    public $metatitle;
    public $metadescription;
    public $image;
    public $price;
    public $taxable;
    public $keywords;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->description = "";
        $this->sku = "";
        $this->model = "";
        $this->seourl = "";
        $this->metakeywords = "";
        $this->metadescription = "";
        $this->metatitle = "";
        $this->image = "";
        $this->price = 0.0;
        $this->taxable = false;
        $this->keywords = "";
        $this->table = ARCDBPREFIX . "store_products";
        $this->columns = ["id", "name", "description", "sku", "model", "seourl", "metakeywords", "metatitle", "metadescription", 
            "image", "price", "taxable", "keywords"];
    }
    
    public static function getBySEOUrl($seourl) {
        $product = new Product();
        $product->get(["SEOUrl" => $seourl]);
        return $product;
    }
    
    public static function getProducts() {
        $products = new Product();
        return $products->getCollection([]);
    }
}
