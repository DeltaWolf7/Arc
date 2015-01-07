<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "app/modules/store/administration/css/styles.css");

switch (system\Helper::arcGetURLData("action")) {
    case "products":
        system\Helper::arcOverrideView("products", true);
        break;
    case "categories":
        system\Helper::arcOverrideView("categories", true);
        break;
    case "orders":
        system\Helper::arcOverrideView("orders", true);
        break;
    case "customers":
        system\Helper::arcOverrideView("customers", true);
        break;
    case "settings":
        system\Helper::arcOverrideView("settings", true);
        break;
    default:
        system\Helper::arcOverrideView("overview", true);
        break;
}