<div class="page-header">
    <h1>Clients</h1>
</div>

<?php
if (arcGetURLData("data2") == null) {
    ?>

    <script>
        function dosearch() {
            var search = document.getElementById("search").value;
            window.location = '<?php echo arcGetModulePath(); ?>search/' + search;
        }
    </script>

    <form role="form">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <h4>Search</h4>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">            
                    <input maxlength="50" type="search" class="form-control" id="search" placeholder="Search">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="dosearch()"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </div>

    </form>

    <table class="table table-striped">
        <tr>
            <th><span class="glyphicon glyphicon-th"></span></th>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Sex</th>
            <th>Documents</th>
        </tr>
        <?php
        $user = arcGetUser();
        
        $clients = new Client();
        $data = $clients->getClients($user->id);
               
        foreach ($data as $client) {
            $will = Will::getByClientID($client->id);
            echo "<tr><td><span class=\"glyphicon glyphicon-user\"></span></td><td>" . $client->id . "</td><td><a href='" . arcGetModulePath() . "clients/" . $client->id . "'>" . $client->name . "</a></td><td>" . $client->phone . "</td><td>" . $client->dob . "</td><td>" . $client->sex . "</td><td>";
            if ($will->id <> "0")
            {
                echo "<span class=\"badge\"><span class=\"glyphicon glyphicon-tag\"> Will</span></span>";
            }
            echo "</td></tr>";
        }
        ?>
    </table>

    <p class="text-right">
        <button type="button" class="btn btn-primary" onclick="window.location = '<?php echo arcGetModulePath(); ?>clients/0'"><span class="glyphicon glyphicon glyphicon-user"></span> New Client</button>
    </p>

    <?php
} else {
    $client = new Client();   
    if (arcGetURLData("data2") != "0") {
        $client->getByID(arcGetURLData("data2"));
    }
    ?>

    <form role="form">
        <div class="row">
            <div class="col-md-6"><div class="form-group">
                    <label for="name">Name</label>
                    <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter Client Name" value="<?php echo $client->name; ?>">
                </div></div>
            <div class="col-md-6"><div class="form-group">
                    <label for="dob">DOB</label>
                    <input maxlength="10" type="text" class="form-control" id="dob" placeholder="Enter Client DOB" value="<?php echo $client->dob; ?>">
                </div></div>
        </div>
        <div class="row">
            <div class="col-md-6"><div class="form-group">
                    <label for="sex">Sex</label>
                    <select id="sex" class="form-control">
                        <?php
                        if ($client->sex == "M") {
                            echo "<option value=\"M\" selected>Male</option>";
                            echo "<option value=\"F\">Female</option>";
                        } else {
                            echo "<option value=\"M\">Male</option>";
                            echo "<option value=\"F\" selected>Female</option>";
                        }
                        ?>
                    </select>
                </div></div>
            <div class="col-md-6"><div class="form-group">
                    <label for="disabled">Disabled</label>
                    <select id="disabled" class="form-control">
                        <?php
                        if ($client->disabled == false) {
                            echo "<option value=\"false\" selected>No</option>";
                            echo "<option value=\"true\">Yes</option>";
                        } else {
                            echo "<option value=\"false\">No</option>";
                            echo "<option value=\"true\" selected>Yes</option>";
                        }
                        ?>
                    </select>
                </div></div>
        </div>  
        <div class="row">
            <div class="col-md-6"><div class="form-group">
                    <label for="phone">Phone</label>
                    <input maxlength="20" type="text" class="form-control" id="phone" placeholder="Enter Client Phone" value="<?php echo $client->phone; ?>">
                </div></div>
            <div class="col-md-6">&nbsp;</div>
        </div>
        <input type="hidden" id="id" value="<?php echo arcGetURLData("data2"); ?>">

        <h3>Addresses</h3>
        <table class="table table-striped">
            <tr>
                <th><span class="glyphicon glyphicon-th"></span></th>
                <th>ID</th>
                <th>Address</th>
                <th>Post Code</th>
                <th>Primary</th>
            </tr>
            <?php
            $data = Address::getAddresses($client->id);
            
            foreach ($data as $address) {
                echo "<tr><td><span class=\"glyphicon glyphicon-home\"></span></td><td>" . $address->id . "</td><td><a href='" . arcGetModulePath() . "addresses/" . $address->id . "/" . $address->clientid. "'>" . $address->address1. ", " . $address->address2 . ", " . $address->address3 . "</a></td><td>" . $address->postcode. "</td><td>";
                if ($address->pri == true) {               
                    echo "<span class=\"badge\"><span class=\"glyphicon glyphicon-tag\"> Default</span></span>";
                } else {
                    echo "&nbsp;";
                }
                echo "</td></tr>";
            }
            ?>
        </table>


        <p class="text-right">
            <button type="button" class="btn btn-warning" onclick="window.location = '<?php echo arcGetModulePath(); ?>will/<?php echo $client->id; ?>'"><span class="glyphicon glyphicon glyphicon-list-alt"></span>
            <?php
            
             $will = Will::getByClientID($client->id);
            if ($will->id != 0) {
                echo "Edit Will";
            } else {
                echo "Create Will";
            }
            ?>
            </button>
            <button type="button" class="btn btn-primary" onclick="window.location = '<?php echo arcGetModulePath(); ?>addresses/0/<?php echo $client->id; ?>'"><span class="glyphicon glyphicon glyphicon-home"></span> New Address</button>
            <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'saveclient', id: '#id', name: '#name', dob: '#dob', userid: '<?php echo $user->id; ?>',
                        sex: '#sex', disabled: '#disabled', phone: '#phone'}, '<?php arcGetDispatch(); ?>', updateStatus, true)"><span class="glyphicon glyphicon-floppy-disk"></span> Save Client</button>
            <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo arcGetModulePath(); ?>clients'"><span class="glyphicon glyphicon glyphicon-remove"></span> Exit To Clients</button>
        </p>
    </form>
    
    <script>
$('#dob').datepicker({format: 'yyyy-mm-dd'});
</script> 

    <?php
}