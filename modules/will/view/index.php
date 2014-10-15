<?php


$module = "clients";
if (!empty(arcGetURLData("data1"))) {
    $module = arcGetURLData("data1");
}

include arcGetModulePath(true) . "/pages/" . $module . ".php";

?>

