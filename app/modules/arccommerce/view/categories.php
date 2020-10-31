<?php
    if (count($categories) > 0) {
?>

<div class="card-columns">
    <?php
            // Categories
            foreach ($categories as $category) {
        ?>

    <div class="card">
        <a href="/categories/<?php echo $category->getSEOUrl(); ?>">
            <img class="card-img-top img-fluid" src="<?php echo $imagePath . $category->image; ?>"
                alt="<?php echo $category->name; ?>">
        </a>
        <div class="card-footer text-muted text-center">
            <a href="/categories/<?php echo $category->getSEOUrl(); ?>">
                <h6 class="card-title"><?php echo $category->name ?></h6>
            </a>
        </div>
    </div>

    <?php
            }
            ?>
</div>
<?php
}

if (count($products) > 0) {
    ?>
<div class="row">
    <?php
        // Products (Shown when category has no children).
        foreach ($products as $product) {
            $image = ArcEcomImage::getByProductIDAndType($product->id, "IMAGE");
            if ($image->id == 0) {
                $image = ArcEcomImage::getByProductIDAndType($product->id, "THUMB");
            }
            ?>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="row">
                <div class="col-md-3">
                    <a href="/products/<?php echo $product->getSEOUrl(); ?>">
                        <img class="card-img-top img-fluid" src="<?php echo $imagePath . $image->filename; ?>"
                            alt="<?php echo $product->name; ?>">
                    </a>
                </div>
                <div class="col-md-9">
                <a href="/products/<?php echo $product->getSEOUrl(); ?>">
                    <h4 class="card-title"><?php echo $product->name ?></h4>
                    <h5 class="text-primary mt-2">£<?php echo $product->price; ?></h5>
                </a>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
            ?>
</div>
<?php
}