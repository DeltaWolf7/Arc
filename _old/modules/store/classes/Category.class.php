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
 * Description of Category
 *
 * @author craig
 */
class Category extends DataProvider {
    
    public $name;
    public $sortorder;
    public $parentid;
    public $image;
    public $keywords;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->sortorder = 0;
        $this->parentid = 0;
        $this->image = "";
        $this->keywords = "";
        $this->table = ARCDBPREFIX . "store_categories";
        $this->columns = ["id", "name", "sortorder", "parentid", "image", "keywords"];
    }
    
    public static function getChildren($parentid) {
        $categories = new Category();
        return $categories->getCollection(["parentid" => $parentid, "ORDER" => "sortorder"]);
    }
    
    public static function getRootCategories() {
        $categories = new Category();
        return $categories->getCollection(["parentid" => "0", "ORDER" => "sortorder"]);
    }
    
    public function getProducts() {
        $products = new ProductCategory();
        return $products->getCollection(["categoryid" => $this->id]);
    }
}
