<?php
if (isset($_POST["action"])) {
if ($_POST["action"] == "deleteproduct") {
        
        $product = new Product();
        $product->delete($_POST["id"]);
        
        echo "success|Product deleted.";
    } elseif ($_POST["action"] == "saveproduct") {
        
        $product = new Product();
        $product->getByID($_POST["id"]);
        
        $product->name = $_POST["name"];
        $product->description = $_POST["description"];
        $product->keywords = $_POST["keywords"];
        $product->metadescription = $_POST["metadescription"];
        $product->metakeywords = $_POST["metakeywords"];
        $product->metatitle = $_POST["metatitle"];
        $product->model = $_POST["model"];
        
        if (!is_numeric($_POST["price"])) {
            echo "danger|Invalid price.";
            return;
        }
        
        $product->price = $_POST["price"];
        
        $seoproduct = Product::getBySEOUrl($_POST["seourl"]);
        if ($seoproduct->id != $product->id) {
            echo "danger|SEO Url already in use..";
            return;
        }
        
        $product->seourl = $_POST["seourl"];
        $product->sku = $_POST["sku"];
        $product->taxable = $_POST["taxable"];
        $product->update();
        
        echo "success|Product saved.";
    }
}