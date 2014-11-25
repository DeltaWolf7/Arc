<?php

if (isset($_POST["action"])) {
    
    include "../../../../system/bootstrap.php";
    
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
    }
} else {  
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