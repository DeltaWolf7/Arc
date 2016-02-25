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
    public $serviceType;
    public $currency;
    public $supplierAnnualCost;
    public $rdPartySupplier;
    public $supplierCover;
    public $termsJSON;
    public $commercialJSON;
    public $additionalNotes;
    public $onboardingJSON;
    
    public function __construct() {
        parent::__construct();
        $this->table = "caf";
        $this->columns = [];
    }

}
