<table>
    <thead>
        <tr><th>ID</th><th>Customer</th><th>Date Created</th><th>Last Editor</th><th><a class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Create</a></th></tr>
    </thead>
    <tbody>
        <?php
            $cafs = CAF::getAll();
            foreach ($cafs as $caf) {
                echo "<tr><td>{$caf->id}</td><td>{$caf->customerLegalName}</td><td>{$caf->datecreated}</td><td>{$caf->lasteditor}</td><td><a class=\"btn btn-default btn-xs\"><i class=\"fa fa-plus\"></i> Create</a></td></tr>";
            }
        ?>
    </tbody>
</table>


<div class="modal fade" id="cafModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">CAF Editor</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Customer Legal Name</span>
                                <input id="customerLegalName" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Address</span>
                                <textarea id="customerAddress" type="text" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Customer Status</span>
                                <input id="customerStatus" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Invoice Address</span>
                                <textarea id="invoiceAddress" type="text" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Order Date</span>
                                <input id="orderDate" type="date" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Contract Reference</span>
                                <input id="contractReference" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Requested Service Date</span>
                                <input id="requestedServiceDate" type="date" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">GP Debtor ID</span>
                                <input id="gpDebtorID" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">GP Contract Reference</span>
                                <input id="gpContractReference" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>

                <h4>Service Information</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Service Type</span>
                                <input id="serviceType" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Currency £</span>
                                <input id="currency" type="number" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">Supplier Annual Cost £</span>
                            <input id="supplierAnnualCost" type="number" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">3rd Party Supplier Name</span>
                                <input id="3rdPartySupplier" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Supplier Period of Cover</span>
                                <input id="supplierCover" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms1" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms2" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms3" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms4" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms5" type="text" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Terms</span>
                                <input id="terms6" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>

                <h4>Commercial Parameters</h4>

                <div class="row">
                    <table class="table table-grid">
                        <tr>
                            <th>Order Type</th>
                            <th>Billing Period</th>
                            <th>Invoice Generation Days</th>
                            <th>Invoice Credit Days</th>
                            <th>Initial Term Months</th>
                            <th>Notice Period Days</th>
                            <th>Follow on Term</th>
                            <th>Fixed/Rolling</th>
                            <th>Installation Fee £</th>
                            <th>Base Recurring Fee £</th>
                        </tr>
                        <tr>
                            <td><input id="t1" type="text" class="form-control" /></td>
                            <td><input id="t2" type="text" class="form-control" /></td>
                            <td><input id="t3" type="text" class="form-control" /></td>
                            <td><input id="t4" type="text" class="form-control" /></td>
                            <td><input id="t5" type="text" class="form-control" /></td>
                            <td><input id="t6" type="text" class="form-control" /></td>
                            <td><input id="t7" type="text" class="form-control" /></td>
                            <td><input id="t8" type="text" class="form-control" /></td>
                            <td><input id="t9" type="text" class="form-control" /></td>
                            <td><input id="t10" type="text" class="form-control" /></td>
                        </tr>
                    </table>
                </div>

                <h4>Additional Notes</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <textarea id="additionalNotes" type="text" class="form-control" rows="20" cols="800"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <h4>Contract On-boarding Process Tasks</h4>

                <table class="table table-striped">
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Stakeholder Bid Meeting with the Client Account Manager</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c2"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner2" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate2" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Stakeholder on board meeting held by the Client Account Manager (where applicable: MD/Sales Director/Service Operations Manager/Purchasing Manager/Service Desk Manager/Team member from Ops Bridge & Professional Services)</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c3"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner3" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate3" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Client Account Manager to create CAF</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c4"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner4" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate4" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Client Account Manager will send CAF/ Costing Sheet/ SDD/ Any Sub-Contract quotes to Contracts Admin</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c5"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner5" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate5" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin will create a contract file in the sdrive /contracts admin folder and if the order is a new customer their details will be added at the org level created in HOTH</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c6"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner6" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate6" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin to pass the CAF and any sub costs to the Sales Admin for loading onto GP and an sales order to be created</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c7"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner7" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate7" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Sales Admin will send Contracts Admin the Basic Sales Order Created on Great Plains with the full and final sales details along with the signed off CAF</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c8"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner8" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate8" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin to send CAF/Sales Order/3rd Party Supplier Sub Quotations to the Purchasing Manager to raise a Purchase Order </div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c9"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner9" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate9" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Purchasing Manager to return the signed off CAF and copy of the raised Purchase Order to Contracts Admin</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c10"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner10" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate10" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin to send 3rd Party Supplier Quotation and Purchase Order  to Supplier
                                    <br />Once Supplier contract received add details to costing sheet/HOTH/Contracts Sub Calendar and file
                                </div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c11"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner11" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate11" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin will notify the Service Desk Manager, Customer Service Manager and Service Operations Manager of the new contract including Help Desk</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c12"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner12" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate12" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Draft Contract is produced by Contracts Administration and sent to the Client Account Manager and MD for approval</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c13"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner13" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate13" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Final Contract sent to the client by Echosign or Printed copy for signature cc / inform Client Account Manager</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c14"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner14" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate14" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contract received signed by Client and Managing Director (Inform Client Account Manager if signed contract completed by post has been received) </div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c15"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner15" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate15" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">ONLY WHERE APPLICABLE: Contract Admin to follow procedure for unsigned contracts and send a letter to the customer</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c16"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner16" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate16" type="date" class="form-control" /></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">Contracts Admin to process the following: Add contract to HOTH and move customer from WIP to Live Customer folder in sdrive/ Add customer sites to Job Watch / Welcome letter to Customer </div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c17"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner17" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate17" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Logistics to raise a Capex for in-house spares / loans and pass to the Managing Director for approval</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c18"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner18" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate18" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Logistics to process and purchase required stock</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c19"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner19" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate19" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Logistics to send a notification of any delays that are to be expected on the order of spares to the following:
                                    <br />Client Account Manager, Purchasing Manager, Customer Service Manager, Service Desk Manager
                                </div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c20"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner20" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate20" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Contracts Admin to send CAF to Finance (invoicing@concordeitgroup.com & cc Financial Controller) once contract start is confirmed</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c21"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner21" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate21" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Finance to schedule invoice as per commercial details on CAF</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c22"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner22" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate22" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Invoice Raised</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c23"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner23" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate23" type="date" class="form-control" /></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">Finance to return the signed off CAF back to Contracts Admin to file as completed in the customer folder in the sdrive</div>
                                <div class="col-md-2"><div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="c24"> Completed
                                        </label>
                                    </div></div>
                                <div class="col-md-2"><input id="actioner24" type="text" class="form-control" /></div>
                                <div class="col-md-2"><input id="actionerDate24" type="date" class="form-control" /></div>
                            </div>
                    </tr>
                </table>




            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveBtn">Save</a>
            </div>
        </div>
    </div>
</div>
