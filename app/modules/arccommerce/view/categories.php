<div class="row mb-3 mt-3">
    <div class="col-md-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php if (isset($bread)) { echo $bread; } ?>
            </ol>
        </nav>
    </div>
    <div class="col-md-2">
        <?php if (count($products) > 0) { ?>
        <ul class="nav mt-1">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false"><i class="fas fa-sort"></i> Sort By</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" onclick="sort('az')"><i class="fas fa-sort-alpha-down"></i> Name (A to
                        Z)</a>
                    <a class="dropdown-item" onclick="sort('za')"><i class="fas fa-sort-alpha-down-alt"></i> Name (Z
                        to
                        A)</a>
                    <a class="dropdown-item" onclick="sort('lh')"><i class="fas fa-sort-numeric-down"></i> Price (Low
                        to
                        High)</a>
                    <a class="dropdown-item" onclick="sort('hl')"><i class="fas fa-sort-numeric-down-alt"></i> Price
                        (High to Low)</a>
                </div>
            </li>
        </ul>
        <?php } ?>
    </div>
</div>


<?php
    if (count($categories) > 0 || count($products) > 0) {
        echo "<div class=\"row row-cols-1 row-cols-md-4 g-4\">";
    if (count($categories) > 0) {
  // Categories
            foreach ($categories as $category) {
        ?>
<div class="col">
    <div class="card">
        <a href="/categories/<?php echo $category->getSEOUrl(); ?>">
            <?php
    $cat_image = system\Helper::arcGetPath(true) . "assets/categories/" . $category->image;
    if (!file_exists($cat_image)) {
        $cat_image = "<div style=\"height: 100px;\" class=\"text-center pt-4\"><h3>" . $category->name . "</h3></div>";
        echo $cat_image;
    } else {
        ?>
            <img class="card-img-top img-fluid" src="<?php echo $catImagePath  . $category->image; ?>"
                alt="<?php echo $category->name; ?>">
            <?php
    }
    
?>
        </a>
    </div>
</div>

<?php
            }
}

if (count($products) > 0) {
        // Products (Shown when category has no children).
        foreach ($products as $product) {
            $image = ArcEcomImage::getByProductIDAndType($product->id, "IMAGE");
            if ($image->id == 0) {
                $image = ArcEcomImage::getByProductIDAndType($product->id, "THUMB");
            }
            ?>
<div class="col">
    <div class="card">
        <a href="/products/<?php echo $product->getSEOUrl(); ?>">
            <img class="card-img-top img-fluid" loading="lazy" src="<?php echo $imagePath . $image->filename; ?>"
                alt="<?php echo $product->name; ?>" width="250px" height="250px">
        </a>
        <div class="card-body text-sm mt-0 pt-0">
            <hr />
            <strong><?php echo $product->name; ?></strong>
            <div class="row">
                <div class="col-md-6">
                    £<?php echo $product->price; ?>
                </div>
                <div class="col-md-6 text-end">
                    <?php
                    if ($product->checkStock()) {
                        echo "<i class=\"badge bg-success\">In Stock</i>";
                    } else {
                        echo "<i class=\"badge bg-danger\">Out of Stock</i>";
                    }
                ?>
                </div>
            </div>
            </i>
        </div>
    </div>
</div>
<?php
            } 
            ?>

<?php
} 
echo "</div>";
} else {

    ?>

<h2>Sorry, we didn't find what you were looking for..</h2>

<?php
}
?>