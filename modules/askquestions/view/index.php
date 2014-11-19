<?php

if (arcGetURLData("data1") == null) {
    include arcGetModulePath(true) . "/view/default.php";
} else {
    include arcGetModulePath(true) . "/view/" . arcGetURLData("data1")  . ".php";
}

?>

