<div class="page-header">
    <h1>This is the last Will and Testament</h1>
</div>

<?php
$user = arcGetUser();

$client = new Client();
$client->getByID(arcGetURLData("data2"));

if (arcGetURLData("data2") == "0") {
    echo "No client";
    echo "<script>alert('You can only create wills for valid clients.');window.location='" . arcGetModulePath() . "/clients/" . $client->id . "';</script>";
    exit();
}

$will = Will::getByClientID($client->id);

$address = Address::getPrimary($client->id);

if ($address->pri == false) {
    echo "No address";
    echo "<script>alert('No primary address defined for this client, please specify the clients primary address.');window.location='" . arcGetModulePath() . "/clients/" . $client->id . "';</script>";
    exit();
}
?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#client" role="tab" data-toggle="tab">Client Details</a></li>
    <li><a href="#executors" role="tab" data-toggle="tab">Executors</a></li>
    <li><a href="#guardians" role="tab" data-toggle="tab">Guardians</a></li>
    <li><a href="#legacies" role="tab" data-toggle="tab">Legacies</a></li>
    <li><a href="#charitable" role="tab" data-toggle="tab">Charitable Legacies</a></li>
    <li><a href="#property" role="tab" data-toggle="tab">Property</a></li>
    <li><a href="#residue" role="tab" data-toggle="tab">Residue</a></li>
    <li><a href="#custom" role="tab" data-toggle="tab">Custom Clauses</a></li>
</ul>
<form role="form">
    <div class="tab-content">


        <div class="tab-pane fade in active" id="client">

            <h2>Client Details</h2>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="clientName">Name</label>
                    <input type="text" class="form-control" id="clientName" placeholder="Client Name" disabled="true" value="<?php echo $client->name; ?>">
                </div>
                <div class="form-group">
                    <label for="address1">Address</label>
                    <input type="text" class="form-control" id="address1" placeholder="Address" disabled="true" value="<?php echo $address->address1; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="address2" disabled="true" value="<?php echo $address->address2; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="address3" disabled="true" value="<?php echo $address->address3; ?>">
                </div>
                <div class="form-group">
                    <label for="postcode">Post Code</label>
                    <input type="text" class="form-control" id="postcode" placeholder="Post Code" disabled="true" value="<?php echo $address->postcode; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone" disabled="true" value="<?php echo $client->phone; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" class="form-control" id="dob" placeholder="DOB" disabled="true"  value="<?php echo $client->dob; ?>">
                </div>
                <div class="form-group">
                    <label for="sex">Sex</label>
                    <select class="form-control" id="sex" disabled="true">
                        <option value="M" <?php if ($client->sex == "M") echo "selected"; ?>>Male</option>
                        <option value="F" <?php if ($client->sex == "F") echo "selected"; ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="blind">Disabled</label>
                    <select class="form-control" id="blind" disabled="true">
                        <option <?php if ($client->disabled == "0") echo "selected"; ?>>No</option>
                        <option <?php if ($client->disabled == "1") echo "selected"; ?>>Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="partner">Partner</label>
                    <select class="form-control" id="partner">
                        <option value="0">(0) None</option>
                        <?php
                        $clis = Client::getClients($user->id);
                        foreach ($clis as $cli) {
                            if ($cli->id != $client->id) {
                                echo "<option value='" . $cli->id . "'";
                                if ($will->partnerid == $cli->id) {
                                    echo ' selected';
                                }
                                echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="relationship">Relationship</label>
                    <select class="form-control" id="relationship">
                        <option<?php if ($will->relationship == "Spouse") echo " selected"; ?>>Spouse</option>
                        <option<?php if ($will->relationship == "Parent") echo " selected"; ?>>Parent</option>
                        <option<?php if ($will->relationship == "Fiancee") echo " selected"; ?>>Fiancee</option>
                        <option<?php if ($will->relationship == "Same Sex Partner") echo " selected"; ?>>Same Sex Partner</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="executors">
            <h2>Executors</h2>
            <div class="form-group">
                <label for="exe1">Executor 1</label>
                <select class="form-control" id="exe1">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->exe1 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exe2">Executor 2</label>
                <select class="form-control" id="exe2">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->exe2 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exe3">Executor 3</label>
                <select class="form-control" id="exe3">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->exe3 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exe4">Executor 4</label>
                <select class="form-control" id="exe4">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->exe4 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="tab-pane fade" id="guardians">
            <h2>Guardians</h2>
            <div class="form-group">
                <label for="hChildren">Has Children</label>
                <select class="form-control" id="hChildren" onchange="hasChildren();">
                    <option value="No"<?php
                    if ($will->gua == "No") {
                        echo " selected";
                    }
                    ?>>No</option>
                    <option value="Yes"<?php
                    if ($will->gua == "Yes") {
                        echo " selected";
                    }
                    ?>>Yes</option>
                </select>
            </div>
            <div id="hasChildren" style="display:none;">
                <div class="form-group">
                    <label for="gua1">Guardian 1</label>
                    <select class="form-control" id="gua1">
                        <option value="0">(0) None</option>
                        <?php
                        $clis = Client::getClients($user->id);
                        foreach ($clis as $cli) {
                            if ($cli->id != $client->id) {
                                echo "<option value='" . $cli->id . "'";
                                if ($will->gua1 == $cli->id) {
                                    echo " selected";
                                }
                                echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gua2">Guardian 2</label>
                    <select class="form-control" id="gua2">
                        <option value="0">(0) None</option>
                        <?php
                        $clis = Client::getClients($user->id);
                        foreach ($clis as $cli) {
                            if ($cli->id != $client->id) {
                                echo "<option value='" . $cli->id . "'";
                                if ($will->gua2 == $cli->id) {
                                    echo " selected";
                                }
                                echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gua3">Guardian 3</label>
                    <select class="form-control" id="gua3">
                        <option value="0">(0) None</option>
                        <?php
                        $clis = Client::getClients($user->id);
                        foreach ($clis as $cli) {
                            if ($cli->id != $client->id) {
                                echo "<option value='" . $cli->id . "'";
                                if ($will->gua3 == $cli->id) {
                                    echo " selected";
                                }
                                echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gua4">Guardian 4</label>
                    <select class="form-control" id="gua4">
                        <option value="0">(0) None</option>
                        <?php
                        $clis = Client::getClients($user->id);
                        foreach ($clis as $cli) {
                            if ($cli->id != $client->id) {
                                echo "<option value='" . $cli->id . "'";
                                if ($will->gua4 == $cli->id) {
                                    echo " selected";
                                }
                                echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="legacies">
            <h2>Legacies</h2>
            <div class="form-group">
                <label for="hLegacies">Has Legacies</label>
                <select class="form-control" id="hLegacies" onchange="hasLegacies();">
                    <option value="No"<?php
                    if ($will->legacies == "No") {
                        echo " selected";
                    }
                    ?>>No</option>
                    <option value="Yes1"<?php
                    if ($will->legacies == "Yes1") {
                        echo " selected";
                    }
                    ?>>Yes - I GIVE the following Legacies absolutely with any tax due to be paid by my estate</option>
                    <option value="Yes2"<?php
                    if ($will->legacies == "Yes2") {
                        echo " selected";
                    }
                    ?>>Yes - I GIVE the following Legacies absolutely and subject to tax payable by the person receiving the legacies</option>
                </select>
            </div>
            <div id="hasLegacies" style="display:none;">
                <div class="form-group">
                    <label for="legs">Legacies</label>
                    <textarea id="legs" class="form-control" rows="10" placeholder="If legacies are to be given (e.g. paintings, furniture, jewellery, gifts of money etc.) please number and describe each legacy and to whom it will be given here, individual legacies can be given free of tax, or subject to it.">
                        <?php
                        if (!empty($will->legs)) {
                            echo $will->legs;
                        }
                        ?>
                    </textarea>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="charitable">
            <h2>Charitable Legacies</h2>
            <div class="form-group">
                <label for="hcLegacies">Has Charitable Legacies</label>
                <select class="form-control" id="hcLegacies" onchange="hasCLegacies();">
                    <option value="No"<?php
                    if ($will->charchoice == "No") {
                        echo " selected";
                    }
                    ?>>No</option>
                    <option value="Yes"<?php
                    if ($will->charchoice == "Yes") {
                        echo " selected";
                    }
                    ?>>Yes</option>
                </select>
            </div>
            <div id="hasCLegacies" style="display:none;">
                <div class="form-group">
                    <label for="char">Charitable Legacies</label>
                    <textarea id="char" class="form-control" rows="10" placeholder="If charitable legacies are to be given please number and describe each legacy and to whom it will be given here.">
                        <?php
                        if (!empty($will->char)) {
                            echo $will->char;
                        }
                        ?>
                    </textarea>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="property">
            <h2>Property</h2>
            <div class="form-group">
                <label for="hProperty">Has Property</label>
                <select class="form-control" id="hProperty" onchange="hasProperty();">
                    <option value="No"<?php
                    if ($will->property == "No") {
                        echo " selected";
                    }
                    ?>>No</option>
                    <option value="Yes1"<?php
                    if ($will->property == "Yes1") {
                        echo " selected";
                    }
                    ?>>I GIVE the following Property absolutely and free of tax and free of any money charged or otherwise secured on the property</option>
                    <option value="Yes2"<?php
                    if ($will->property == "Yes2") {
                        echo " selected";
                    }
                    ?>>I GIVE the following Property subject to tax and any money charged or otherwise secured on the property</option>
                </select>
            </div>
            <div id="hasProperty" style="display:none;">
                <div class="form-group">
                    <label for="prop">Property</label>
                    <textarea id="prop" class="form-control" rows="10" placeholder="If property is the be passed under the will, please number and describe each property, giving its full postal address and to whom it will be given here. Some property can be given free of tax, other property can be subject to it">
                        <?php
                        if (!empty($will->prop)) {
                            echo $will->prop;
                        }
                        ?>
                    </textarea>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="residue">
            <h2>Residue</h2>
            <div class="form-group">
                <label for="res1">Residue 1</label>
                <select class="form-control" id="res1">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->res1 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="res2">Residue 2</label>
                <select class="form-control" id="res2">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->res2 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="res3">Residue 3</label>
                <select class="form-control" id="res3">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->res3 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="res4">Residue 4</label>
                <select class="form-control" id="res4">
                    <option value="0">(0) None</option>
                    <?php
                    $clis = Client::getClients($user->id);
                    foreach ($clis as $cli) {
                        if ($cli->id != $client->id) {
                            echo "<option value='" . $cli->id . "'";
                            if ($will->res4 == $cli->id) {
                                echo " selected";
                            }
                            echo ">(" . $cli->id . ") " . $cli->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="tab-pane fade" id="custom">
            <h2>Custom Clauses</h2>
            <textarea id="customtxt" class="form-control" rows="10" placeholder="Custom clauses">
                <?php
                if (!empty($will->custom)) {
                    echo $will->custom;
                }
                ?>
            </textarea>
        </div>



    </div>
    <div class="clearfix"><br /></div>
    <div class="row text-right">

        <button type="button" class="btn btn-success" onclick="ajax.send('POST',
                        {action: 'savewill', userid: '<?php echo $user->id; ?>', clientid: '<?php echo $client->id; ?>',
                            partnerid: '#partner', relationship: '#relationship', exe1: '#exe1', exe2: '#exe2', exe3: '#exe3', exe4: '#exe4',
                            guaChoice: '#hChildren', gua1: '#gua1', gua2: '#gua2', gua3: '#gua3', gua4: '#gua4', legacies: '#hLegacies', legs: '#legs',
                            charChoice: '#hcLegacies', char: '#char', property: '#hProperty', prop: '#prop', res1: '#res1', res2: '#res2', res3: '#res3', res4: '#res4',
                            custom: '#customtxt'}, '<?php echo arcGetDispatch(); ?>', updateStatus, true);"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo arcGetModulePath() ?>/print/<?php echo $client->id; ?>'"><span class="fa fa-file-pdf-o"></span> Generate PDF</button>
        <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo arcGetModulePath() ?>/clients/<?php echo $client->id; ?>'"><span class="fa fa-remove"></span> Exit To Client</button>
    </div>
</form>

<script>
    function hasChildren() {
        var e = document.getElementById('hChildren');
        if (e.options[e.selectedIndex].text == 'Yes') {
            document.getElementById('hasChildren').style.display = 'block';
        } else {
            document.getElementById('hasChildren').style.display = 'none';
        }
    }

    function hasLegacies() {
        var e = document.getElementById('hLegacies');
        if (e.options[e.selectedIndex].value == 'Yes1' || e.options[e.selectedIndex].value == 'Yes2') {
            document.getElementById('hasLegacies').style.display = 'block';
        } else {
            document.getElementById('hasLegacies').style.display = 'none';
        }
    }

    function hasProperty() {
        var e = document.getElementById('hProperty');
        if (e.options[e.selectedIndex].value == 'Yes1' || e.options[e.selectedIndex].value == 'Yes2') {
            document.getElementById('hasProperty').style.display = 'block';
        } else {
            document.getElementById('hasProperty').style.display = 'none';
        }
    }

    function hasCLegacies() {
        var e = document.getElementById('hcLegacies');
        if (e.options[e.selectedIndex].text == 'Yes') {
            document.getElementById('hasCLegacies').style.display = 'block';
        } else {
            document.getElementById('hasCLegacies').style.display = 'none';
        }
    }
</script>