<div class="card">
    <div class="card-body">
        <?php
    if (isset($product) && $product->id > 0) {
?>

        <div class="row">
            <div class="col-md-6">
                <img id="image" class="img-fluid" loading="lazy" src="<?php echo $path . $images[0]->filename; ?>"
                    alt="<?php echo $product->name; ?>" />
                <div class="row mt-3">
                    <?php
                foreach ($images as $image) {
            ?>
                    <div class="col-md-2"><a href="#"
                            onclick="$('#image').attr('src','<?php echo $path . $image->filename; ?>')"><img
                                class="img-fluid" loading="lazy" height="100px"
                                src="<?php echo $path . $image->filename; ?>" alt="<?php echo $product->name; ?>" /></a>
                    </div>
                    <?php
                }
            ?>
                </div>
            </div>
            <div class="col-md-6">
                <h2><?php echo $product->name; ?></h2>
                <?php system\Helper::arcSetTitleOveride($product->name); ?>
                <h4 class="text-primary">£<?php echo $product->price; ?></h4>
                <h6 class="text-secondary">RRP £<?php echo $product->rrp; ?>, Model: <?php echo $product->model; ?></h6>

                <?php 
                echo "<p class=\"mt-5\"><strong>Availability</strong>&nbsp;";
                    if ($product->checkStock()) {
                            echo "<i class=\"badge bg-success\">In Stock</i>";
                        } else {
                            echo "<i class=\"badge bg-danger\">Out of Stock</i>";
                        }
                    echo "</p>";
                ?>

                <p class="mt-4"><?php echo $product->description; ?></p>
                <p class="mt-5">
                <form method="POST" action="/cart">
                    <input type="hidden" name="product" value="<?php echo $product->id; ?>" />
                    <?php           
            if (count($selectable) > 0) {
                echo "<p><strong>Options</strong></p>";
                foreach ($selectable as $select => $name) {
                    echo "<label for=\"" . $select . "\"><i>" . $select . "</i></label>";
                    echo "<select name=\"" . $select . "\" class=\"form-select\">";
                    for ($i = 0; $i < count($name); $i++) {
                        $itemStock = " (Out of Stock)";
                        if ($name[$i]["stock"] > 0) 
                        {
                             $itemStock = " (In Stock)"; 
                        } else if ($name[$i]["stock"] == -1) {
                            $itemStock = "";
                        }

                        $priceAdjust = "";
                        if ($name[$i]["priceadjust"] > 0) {
                            $priceAdjust = " (+£" . $name[$i]["priceadjust"] . ")";
                        }
                        echo "<option value=\"" . $name[$i]["id"] . "\">" . $name[$i]["value"] . $priceAdjust  . $itemStock . "</option>";
                    }
                    echo "</select>";
                }
            }

            if ($product->stock > 0) {
                ?>
                    <button type="submit" class="mt-4 btn btn-primary btn-block">Add to cart</button>
                    <?php
            }
        ?>

                </form>
                </p>
            </div>
        </div>

        <?php
    if (!empty($features)) {
?>
        <div class="row mt-3">
            <div class="col-md-12">
                <h3>Features</h3>
                <table class="table table-striped">
                    <?php
                    echo $features;
                ?>
                </table>
            </div>
        </div>
        <?php
    }

    // cross sell
    echo "<h3 class=\"mt-3\">Similar Items</h3>";
    $crosssell = ArcEcomProduct::getAllByCategoryID($product->categoryid);
    $used = array();
    $used[] = $product->id;
    if (count($crosssell) >= 4) {
    ?>
        <div class="row">
            <?php
            for ($i = 0; $i < 4; $i++) {
                $rnd = rand(0, count($crosssell) - 1);
                while (in_array($rnd, $used)) {
                    $rnd = rand(0, count($crosssell));
                }
                $used[] = $rnd;

                $images = ArcEcomImage::getAllByProductIDAndType($crosssell[$rnd]->id, "IMAGE");
                if (count($images) == 0) {
                    $images = []; 
                    $images[] = ArcEcomImage::getByProductIDAndType($crosssell[$rnd]->id, "THUMB");
                }
            
        ?>
            <div class="col-sm-3">
                <div class="card">
                    <img src="<?php echo $path . $images[0]->filename; ?>" class="card-img-top" alt="<?php echo $crosssell[$rnd]->name; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $crosssell[$rnd]->name; ?></h5>
                        <p class="card-text"><strong>£<?php echo $crosssell[$rnd]->price; ?></strong></p>
                        <a href="/products/<?php echo $crosssell[$rnd]->getSEOUrl(); ?>" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <?php
    }
?>
        </div>
        <?php
    }
} else {

    ?>

        <div class="row justify-content-center pos-rel">

            <div class="pos-rel col-12 col-sm-7 mt-1 mt-sm-3">
                <div class="py-3 px-1 py-lg-4 px-lg-5">

                    <div class="text-center fa-4x">
                        <span class="text-100 text-dark-m3 d-sm-none">
                            <!-- smaller text to fit in small devices -->
                            ¯\_(ツ)_/¯
                        </span>
                        <span class="text-110 text-dark-m3 d-none d-sm-inline">
                            ¯\_(ツ)_/¯
                        </span>
                    </div>


                    <div class="text-center fa-4x text-orange-d2 letter-spacing-4">
                        Lost?
                    </div>


                    <div class="text-center">
                        <span class="text-150 text-primary-d2">
                            Sorry, I don't know what product you are trying to find..
                        </span>
                    </div>


                    <div class="text-dark-m2 text-110 text-center mt-45">
                        Try using the search or browse the categories.
                    </div>


                    <div class="text-center mt-4">
                        <a href="/" class="btn btn-bgc-white btn-outline-primary px-35">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </div>


                </div>
            </div>
        </div>

        <?php
}
?>

    </div>
</div>