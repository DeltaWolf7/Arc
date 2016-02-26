<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAF
 *
 * @author clongford
 */
class CAF extends DataProvider {
   
    public $customerLegalName;
    public $customerAddress;
    public $customerStatus;
    public $invoiceAddress;
    public $orderDate;
    public $contractReference;
    public $requestedServiceDate;
    public $gpDebtorID;
    public $gpContractReference;
    public $serviceInformationJSON;
    public $commercialJSON;
    public $additionalNotes;
    public $onboardingJSON;
    
    public function __construct() {
        parent::__construct();
        $this->table = "conc_caf";
        $this->columns = ["id", "customerLegalName", "customerAddress", "customerStatus", "invoiceAddress",
            "orderDate", "contractReference", "requestedServiceDate", "gpDebtorID", "gpContractReference",
            "serviceInformationJSON", "commercialJSON", "additionalNotes", "onboardingJSON"];
    }

     public static function getAll() {
        $caf = new CAF();
        return $caf->getCollection(["ORDER" => "customerLegalName ASC"]);
    }
}
