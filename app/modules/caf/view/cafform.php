<div class="row">
    <div class="col-md-3"><a class="btn btn-primary btn-lg text-center btn-block" onclick="edit(0)"><span class="fa fa-plus-circle fa-4x"></span><br /><br />Create New<br/>&nbsp;</a></div>
    <?php
    $cafs = CAF::getAll();
    foreach ($cafs as $caf) {
        echo "<div class=\"col-md-3\"><a class=\"btn btn-default btn-lg text-center btn-block\" onclick=\"edit({$caf->id})\"><span class=\"fa fa-file-o fa-4x\"></span><br>{$caf->customerLegalName}<br />{$caf->orderDate}<br />{$caf->contractReference}</a></div>";
    }
    ?>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Customer Details
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Customer Legal Name</span>
                                                <input id="customerLegalName" type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
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
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Invoice Address</span>
                                                <textarea id="invoiceAddress" type="text" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Order Details
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">

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
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">GP Contract Reference</span>
                                                <input id="gpContractReference" type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Service Information
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">

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
                                                <input id="currency" type="text" class="form-control" />
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
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Supplier Period of Cover</span>
                                                <input id="supplierCover" type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Terms</span>
                                                <textarea rows="4" class="form-control" id="terms" cols="300"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Commercial Parameters
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">

                                <div class="row">
                                    <table class="table table-grid small">
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

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Additional Notes
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea id="additionalNotes" type="text" class="form-control" rows="10" cols="800"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingSix">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Contract On-boarding Process Tasks
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                            <div class="panel-body">

                                <table class="table table-striped small">
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Stakeholder Bid Meeting with the Client Account Manager</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a1">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Stakeholder on board meeting held by the Client Account Manager (where applicable: MD/Sales Director/Service Operations Manager/Purchasing Manager/Service Desk Manager/Team member from Ops Bridge & Professional Services)</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a2">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Client Account Manager to create CAF</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a3">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Client Account Manager will send CAF/ Costing Sheet/ SDD/ Any Sub-Contract quotes to Contracts Admin</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a4">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin will create a contract file in the sdrive /contracts admin folder and if the order is a new customer their details will be added at the org level created in HOTH</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a5">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin to pass the CAF and any sub costs to the Sales Admin for loading onto GP and an sales order to be created</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a6">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Sales Admin will send Contracts Admin the Basic Sales Order Created on Great Plains with the full and final sales details along with the signed off CAF</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a7">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin to send CAF/Sales Order/3rd Party Supplier Sub Quotations to the Purchasing Manager to raise a Purchase Order </div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a8">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Purchasing Manager to return the signed off CAF and copy of the raised Purchase Order to Contracts Admin</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a9">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin to send 3rd Party Supplier Quotation and Purchase Order  to Supplier
                                                    <br />Once Supplier contract received add details to costing sheet/HOTH/Contracts Sub Calendar and file
                                                </div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a10">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin will notify the Service Desk Manager, Customer Service Manager and Service Operations Manager of the new contract including Help Desk</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a11">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Draft Contract is produced by Contracts Administration and sent to the Client Account Manager and MD for approval</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a12">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Final Contract sent to the client by Echosign or Printed copy for signature cc / inform Client Account Manager</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a13">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contract received signed by Client and Managing Director (Inform Client Account Manager if signed contract completed by post has been received) </div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a14">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">ONLY WHERE APPLICABLE: Contract Admin to follow procedure for unsigned contracts and send a letter to the customer</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a15">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin to process the following: Add contract to HOTH and move customer from WIP to Live Customer folder in sdrive/ Add customer sites to Job Watch / Welcome letter to Customer </div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a16">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Logistics to raise a Capex for in-house spares / loans and pass to the Managing Director for approval</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a17">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Logistics to process and purchase required stock</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a18">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Logistics to send a notification of any delays that are to be expected on the order of spares to the following:
                                                    <br />Client Account Manager, Purchasing Manager, Customer Service Manager, Service Desk Manager
                                                </div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a19">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Contracts Admin to send CAF to Finance (invoicing@concordeitgroup.com & cc Financial Controller) once contract start is confirmed</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a20">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Finance to schedule invoice as per commercial details on CAF</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a21">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Invoice Raised</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a22">Sign Completed</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">Finance to return the signed off CAF back to Contracts Admin to file as completed in the customer folder in the sdrive</div>
                                                <div class="col-md-3 text-right"><a class="btn btn-danger" id="a23">Sign Completed</a></div>
                                            </div>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->