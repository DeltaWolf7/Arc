<?php

if (isset($_POST["action"])) {
    
    require "../../../../config.php";
    
    if ($_POST["action"] == "savesettings") {

        $currencySymbol = SystemSetting::getByKey("ARC_STORE_CURRENCYSYMBOL");
        $currencySymbol->setting = $_POST["currencySymbol"];
        $currencySymbol->update();

        $currenyDisplay = SystemSetting::getByKey("ARC_STORE_CURRENCYDISPLAY");
        $currenyDisplay->setting = $_POST["currencyDisplay"];
        $currenyDisplay->update();

        if (is_numeric($_POST["vat"])) {
            $vat = SystemSetting::getByKey("ARC_STORE_VAT");
            $vat->setting = $_POST["vat"];
            $vat->update();
        } else {
            echo "danger|VAT must be a valid number.";
            return;
        }

        echo "success|Setting saved.";
    } elseif ($_POST["action"] == "deleteproduct") {
        
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
} else {  
    
    arcAddHeader("css", arcGetPath() . "modules/store/administration/css/styles.css");
    
    switch (arcGetURLData("data2")) {
        case "products":
            arcAddView("products");
            break;
        case "categories":
            arcAddView("categories");
            break;
        case "orders":
            arcAddView("orders");
            break;
        case "customers":
            arcAddView("customers");
            break;
        case "settings":
            arcAddView("settings");
            break;
        default:
            arcAddView("overview");
            break;
    }
}