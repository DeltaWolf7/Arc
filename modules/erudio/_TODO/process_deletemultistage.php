<?php

require_once('/bootstrap.php');

$id = $_POST['id'];

$multistage = new multistage();
$multistage->deleteMultistage($id);

echo "Deleted";
