<?php

require_once "../../bootstrap.php";

if ($_POST["action"] == "saveaddress") {
    $address = new Address();
    if ($_POST["id"] != "0") {
        $address->getByID($_POST["id"]);
    }
    $address->userid = $_POST["userid"];
    $address->clientid = $_POST["clientid"];
    
    if (empty($_POST["address1"])) {
        echo "danger|Please provide the first line of the address.";
        exit();
    }
    
    $address->address1 = $_POST["address1"];
    $address->address2 = $_POST["address2"];
    $address->address3 = $_POST["address3"];
    
    if (empty($_POST["postcode"])) {
        echo "danger|Please provide the post code for the address.";
        exit();
    }
    
    $address->postcode = $_POST["postcode"];
    $address->pri = filter_var($_POST["default"], FILTER_VALIDATE_BOOLEAN);
    $address->removeDefaults();
    $address->update();
    echo "success|Address Saved";
} elseif ($_POST["action"] == "saveclient") {
    $client = new Client();
    if ($_POST["id"] != "0") {
        $client->getByID($_POST["id"]);
    }
    $client->userid = $_POST["userid"];
    
    if (empty($_POST["name"])) {
        echo "danger|Please provide a client name.";
        exit();
    }
    
    $client->name = $_POST["name"];
    $client->dob = $_POST["dob"];
    $client->disabled = $_POST["disabled"];
    $client->sex = $_POST["sex"];
    $client->phone = $_POST["phone"];
    $client->update();
    echo "success|Client Saved";
} elseif ($_POST["action"] == "savewill") {
   
    if ($_POST["clientid"] != 0) {
        $will = Will::getByClientID($_POST["clientid"]);    
    }
    
    if ($will->id == 0) {
        $will = new Will();
        $will->clientid = $_POST["clientid"];
    }
    
    $will->userid = $_POST["userid"];
    $will->partnerid = $_POST["partnerid"];
    $will->relationship = $_POST["relationship"];
    $will->exe1 = $_POST["exe1"];
    $will->exe2 = $_POST["exe2"];
    $will->exe3 = $_POST["exe3"];
    $will->exe4 = $_POST["exe4"];
    $will->gua = $_POST["guaChoice"];
    $will->gua1 = $_POST["gua1"];
    $will->gua2 = $_POST["gua2"];
    $will->gua3 = $_POST["gua3"];
    $will->gua4 = $_POST["gua4"];
    $will->legacies = $_POST['legacies'];
    $will->legs = $_POST['legs'];
    $will->charchoice = $_POST['charChoice'];
    $will->char = $_POST['char'];
    $will->property = $_POST['property'];
    $will->prop = $_POST['prop'];
    $will->res1 = $_POST['res1'];
    $will->res2 = $_POST['res2'];
    $will->res3 = $_POST['res3'];
    $will->res4 = $_POST['res4'];
    $will->custom = $_POST['custom'];
    $will->update();
    echo "success|Will Saved";
}
?>