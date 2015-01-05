<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "savesettings") {
        $currencySymbol = SystemSetting::getByKey("ARC_STORE_CURRENCYSYMBOL");
        $currencySymbol->value = $_POST["currencySymbol"];
        $currencySymbol->update();

        $currenyDisplay = SystemSetting::getByKey("ARC_STORE_CURRENCYDISPLAY");
        $currenyDisplay->value = $_POST["currencyDisplay"];
        $currenyDisplay->update();

        if (is_numeric($_POST["vat"])) {
            $vat = SystemSetting::getByKey("ARC_STORE_VAT");
            $vat->value = $_POST["vat"];
            $vat->update();
        } else {
            echo json_encode(["status" => "danger", "data" => "VAT must be a valid number"]);
            return;
        }

        echo json_encode(["status" => "success", "data" => "Settings saved"]);
    }
}