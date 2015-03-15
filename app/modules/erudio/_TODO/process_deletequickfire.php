<?php

require_once('/bootstrap.php');

$id = $_POST['id'];

$multistage = new quickfire();
$multistage->deleteQuickfire($id);

echo "Deleted";
