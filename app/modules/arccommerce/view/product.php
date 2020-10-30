<?php

$uri = system\Helper::arcGetURI();
$data = explode("/", $uri);

if (count($data) > 1) {
    $productdata = explode("-", $data[count($data) - 1]);

    $product = ArcEcomProduct::GetByID($productdata[0]);

    $path = system\Helper::arcGetPath() . "assets/products/";
    $images = ArcEcomImage::getAllByProductIDAndType($product->id, "IMAGE");

    $sizes = ArcEcomAttribute::getAllByProductIDAndName($product->id, "SIZE");
    $colours = ArcEcomAttribute::getAllByProductIDAndName($product->id, "COLOUR");
    $batteries = ArcEcomAttribute::getAllByProductIDAndName($product->id, "BATTERIES");
    $flavours = ArcEcomAttribute::getAllByProductIDAndName($product->id, "FLAVOUR");
?>


<div class="row">
    <div class="col-md-6">
        <img id="image" class="img-fluid" src="<?php echo $path . $images[0]->filename ?>"
            alt="<?php echo $product->name; ?>" />
        <div class="row mt-3">
            <?php
                foreach ($images as $image) {
            ?>
            <div class="col-md-2"><a href="#"
                    onclick="$('#image').attr('src','<?php echo $path . $image->filename; ?>')"><img height="100px"
                        src="<?php echo $path . $image->filename; ?>" /></a></div>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <h3><?php echo $product->name; ?></h3>
        <h4 class="text-primary">£<?php echo $product->price; ?></h4>
        <h6 class="text-secondary">RRP £<?php echo $product->rrp; ?></h6>
        <p class="mt-5"><strong>Availability</strong><br />
            <?php
            if (count($sizes) > 0) {
                echo "<table class=\"table\">";
                foreach ($sizes as $size) {
                    if ($size->stock >= 1) {
                        echo "<tr><td>" . $size->value . "</td><td class=\"text-success\">In stock</td>";
                    } else {
                        echo "<tr><td>" . $size->value . "</td><td class=\"text-danger\">Out of stock</span></td>";
                    }
                }
                echo "</table>";
            } else {
                if ($product->stock >= 1) {
                    echo "<span class=\"text-success\">In stock</span>";
                } else {
                    echo "<span class=\"text-danger\">Out of stock</span>";
                }
            }
        ?>
        </p>
        <p class="mt-4"><?php echo $product->description; ?></p>
        <?php
        // Size
                    if (count($sizes) > 0) {
                ?>
        <label for="size">Size</label>
        <select class="form-control" id="size">
            <?php
                                foreach ($sizes as $size) {
                                    echo "<option value={$size->value}>{$size->value}</option>";
                                }
                            ?>
        </select>
        <?php
                    }
                ?>

        <?php
// Colour
                    if (count($colours) > 0) {
                ?>
        <label for="colour">Colour</label>
        <select class="form-control" id="size">
            <?php
                                foreach ($colours as $colour) {
                                    echo "<option value={$colour->value}>{$colour->value}</option>";
                                }
                            ?>
        </select>
        <?php
                    }
                ?>

        <?php
// Batteries
                    if (count($batteries) > 0) {
                ?>
        <label for="battery">Batteries</label>
        <select class="form-control" id="size">
            <?php
                                foreach ($batteries as $battery) {
                                    echo "<option value={$battery->value}>{$battery->value} - £+{$battery->priceadjust}</option>";
                                }
                            ?>
        </select>
        <?php
                    }
                ?>


<?php
// Flavour
                    if (count($flavours) > 0) {
                ?>
        <label for="flavour">Flavour</label>
        <select class="form-control" id="size">
            <?php
                                foreach ($flavours as $flavour) {
                                    echo "<option value={$flavour->value}>{$flavour->value} - £+{$flavour->priceadjust}</option>";
                                }
                            ?>
        </select>
        <?php
                    }
                ?>

        <button class="mt-4 btn btn-primary btn-block">Add to cart</button>
    </div>
</div>


<?php
}