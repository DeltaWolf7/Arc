<?php
if (empty(arcGetURLData("data1"))) {
    ?>
    <div class="page-header">
        <h1>Coach Manager</h1>
    </div>
    <?php
    include arcGetModulePath(true) . "/view/default.php";
} else {
    include arcGetModulePath(true) . "/view/" . arcGetURLData("data1") . ".php";
}
?>