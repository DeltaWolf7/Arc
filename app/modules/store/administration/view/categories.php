<div class="page-header">
    <h1>Store Categories</h1>
</div>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>Category</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <?php
    $categories = Category::getRootCategories();
    foreach ($categories as $category) {
        ?>

        <tr>
            <td><?php echo $category->id; ?></td>
            <td><?php echo $category->name; ?></td>
            <td></td>
        </tr>


        <?php
    }
    ?>
</table>


<?php

function getChildren($parent) {
    $children = Category::getChildren($parent->id);
    foreach ($children as $child) {
        ?>

        <tr>
            <td><?php echo $child->id; ?></td>
            <td><?php echo $child->name; ?></td>
            <td></td>
        </tr>
        <?php
    }
}
?>