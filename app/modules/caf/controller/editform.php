<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $caf = new CAF();
    $caf->getByID($_POST["id"]);
    
    system\Helper::arcReturnJSON(["customerLegalName" => $caf->customerLegalName,
        "customerAddress" => $caf->customerAddress, "customerStatus" => $caf->customerStatus,
        "invoiceAddress" => $caf->invoiceAddress, "orderDate" => $caf->orderDate,
        "contractReference" => $caf->contractReference, "requestedServiceDate" => $caf->requestedServiceDate,
        "gpDebtorID" => $caf->gpDebtorID, "gpContractReference" => $caf->gpContractReference,
        "serviceInformationJSON" => $caf->serviceInformationJSON, "commercialJSON" => $caf->commercialJSON,
        "additionalNotes" => $caf->additionalNotes, "onboardingJSON" => $caf->onboardingJSON]);    
}