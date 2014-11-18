<div class="page-header">
    <h1>Search</h1>
</div>

<script>
    function dosearch() {
        var search = document.getElementById('search').value;
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

<?php
$user = arcGetUser();

$clients = new Client();
$data = $clients->search(arcGetURLData("data2"));
if (count($data) > 0) {
    ?>
    <p class="lead">Clients</p>
    <table class="table table-striped">
        <tr>
            <th><span class="glyphicon glyphicon-th"></span></th>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Sex</th>
        </tr>
        <?php
        foreach ($data as $client) {
            if ($client->userid == $user->id) {
                echo "<tr><td><span class=\"glyphicon glyphicon-user\"></span></td><td>" . $client->id . "</td><td><a href='" . arcGetModulePath() . "clients/" . $client->id . "'>" . $client->name . "</a></td><td>" . $client->phone . "</td><td>" . $client->dob . "</td><td>" . $client->sex . "</td></tr>";
            }
        }
        ?>
    </table>
    <?php
}


$data = Address::search(arcGetURLData("data2"));
if (count($data) > 0) {
    ?>


    <p class="lead">Addresses</p>
    <table class="table table-striped">
        <tr>
            <th><span class="glyphicon glyphicon-th"></span></th>
            <th>ID</th>
            <th>Address</th>
            <th>Post Code</th>
        </tr>
        <?php
        foreach ($data as $address) {
            if ($address->userid == $user->id) {
                echo "<tr><td><span class=\"glyphicon glyphicon-home\"></span></td><td>" . $address->id . "</td><td><a href='" . arcGetModulePath() . "addresses/" . $address->id . "/" . $address->clientid . "'>" . $address->address1 . ", " . $address->address2 . ", " . $address->address3 . "</a></td><td>" . $address->postcode . "</td></tr>";
            }
        }
        ?>
    </table>

    <?php
}
?>