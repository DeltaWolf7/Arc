<h2>New Products</h2>
<div class="row row-cols-1 row-cols-md-4 g-4">

    <?php

        $products = ArcEcomProduct::getAllNew();
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

</div>