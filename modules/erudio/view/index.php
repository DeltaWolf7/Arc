<?php

if (empty(arcGetURLData("data1"))) {
    include arcGetModulePath(true) . "/pages/default.php";
} else {
    include arcGetModulePath(true) . "/pages/" . arcGetURLData("data1") . ".php";
}
?>
