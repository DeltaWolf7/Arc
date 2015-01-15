<?php

system\Helper::arcAddMenuItem("Store Manager", "fa-shopping-cart", false, null, "Administration");

$currencyDisplay = SystemSetting::keyExists("ARC_STORE_CURRENCYDISPLAY");
if (empty($currencyDisplay->key)) {
    $currencyDisplay = new SystemSetting();
    $currencyDisplay->key = "ARC_STORE_CURRENCYDISPLAY";
    $currencyDisplay->value = "Left";
    $currencyDisplay->update();
}

$currencySymbol = SystemSetting::keyExists("ARC_STORE_CURRENCYSYMBOL");
if (empty($currencySymbol->key)) {
    $currencySymbol = new SystemSetting();
    $currencySymbol->key = "ARC_STORE_CURRENCYSYMBOL";
    $currencySymbol->value = "£";
    $currencySymbol->update();
}

$storeVat = SystemSetting::keyExists("ARC_STORE_VAT");
if (empty($storeVat->key)) {
    $storeVat = new SystemSetting();
    $storeVat->key = "ARC_STORE_VAT";
    $storeVat->value = "20";
    $storeVat->update();
}

$ordernumber = SystemSetting::getByKey("ARC_STORE_ORDERNUMBER");
if (empty($ordernumber->value)) {
    $ordernumber = new SystemSetting();
    $ordernumber->key = "ARC_STORE_ORDERNUMBER";
    $ordernumber->value = "100000";
    $ordernumber->update();
}