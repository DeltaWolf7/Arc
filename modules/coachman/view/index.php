<?php
if (empty(arcGetURLData("data1"))) {
    ?>
    <div class="page-header">
        <h1>Coach Manager</h1>
    </div>
    <?php
    include arcGetModulePath(true) . "/pages/default.php";
} else {
    include arcGetModulePath(true) . "/pages/" . arcGetURLData("data1") . ".php";
}
?>