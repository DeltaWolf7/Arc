<?php

ob_clean();

$client = new Client();
$client->getByID(arcGetURLData("data2"));

if ($client->id == 0) {
    echo "Invalid client";
    exit();
}

$will = Will::getByClientID($client->id);

if ($will->id == 0) {
    echo "No will";
    exit();
}

$number = 1;
$subnumber = 1;

$html = file_get_contents(__DIR__ . "/templates/will.html");
$newHtml = "";

foreach(preg_split("/((\r?\n)|(\r\n?))/", $html) as $line){
    
    // name
    $line = str_replace("[clientname]", $client->name, $line);
    
    // address
    $address = Address::getPrimary($client->id);
    $addressText = $address->address1;
    if (!empty($address->address2)) {
        $addressText .= ", " . $address->address2;
    }
    if (!empty($address->address3)) {
        $addressText .= ", " . $address->address3;
    }
    if (!empty($address->postcode)) {
        $addressText .= ", " . $address->postcode;
    }
    $line = str_replace("[clientaddress]", $addressText, $line);
    
    if (strpos($line, "[mainno]") !== false) {
        $line = str_replace("[mainno]", $number, $line);
        $number++;
        $subnumber = 1;
    }
    
    if (strpos($line, "[subno]") !== false) {
        $line = str_replace("[subno]", $number - 1 . "." . $subnumber, $line);
        $subnumber++;
    }
    
    $exe1 = new Client();
    $exe1->getByID($will->exe1);
     
    if ($exe1->id != 0) {
        $line = str_replace("[executor1name]", $exe1->name, $line);
    } else {
        echo "Will must have at least one executor.";
        exit();
    }
    
    
    // add new line
    $newHtml .= $line;
} 


require_once(__DIR__ . "/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($newHtml);
$dompdf->render();
$dompdf->stream($client->name . " Will.pdf");
?>