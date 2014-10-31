<?php

if (arcGetURLData("data1") == null) {
    include arcGetModulePath(true) . "/pages/default.php";
} else {
    include arcGetModulePath(true) . "/pages/" . arcGetURLData("data1")  . ".php";
}

?>

