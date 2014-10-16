<div class="page-header">
    <h1>Coach Manager <?php if (!empty(arcGetURLData("data1"))) { echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>"; } ?></h1>
</div>

<?php
if (empty(arcGetURLData("data1"))) {
    include arcGetModulePath(true) . "/pages/default.php";
} else {
    include arcGetModulePath(true) . "/pages/" . arcGetURLData("data1") . ".php";
}
?>