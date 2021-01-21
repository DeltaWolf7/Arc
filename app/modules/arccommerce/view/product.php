<?php
    if (isset($product) && $product->id > 0) {
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
                        src="<?php echo $path . $image->filename; ?>" alt="<?php echo $product->name; ?>" /></a></div>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <h3><?php echo $product->name; ?></h3>
        <h4 class="text-primary">£<?php echo $product->price; ?></h4>
        <h6 class="text-secondary">RRP £<?php echo $product->rrp; ?>, Model: <?php echo $product->model; ?></h6>

        <?php 
                echo "<p class=\"mt-5\"><strong>Availability</strong>&nbsp;";
                    if ($product->checkStock()) {
                            echo "<i class=\"badge badge-success\">In Stock</i>";
                        } else {
                            echo "<i class=\"badge badge-danger\">Out of Stock</i>";
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
                    echo "<select name=\"" . $select . "\" class=\"form-control\">";
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
        <table class="table table-striped" aria-label="Features">
            <?php
                    echo $features;
                ?>
        </table>
    </div>
</div>
<?php
    }
} else {

    ?>

<div class="row justify-content-center pos-rel">

              <div class="pos-rel col-12 col-sm-7 mt-1 mt-sm-3">
                <div class="py-3 px-1 py-lg-4 px-lg-5">

                  <div class="text-center fa-4x">
                    <span class="text-100 text-dark-m3 d-sm-none"><!-- smaller text to fit in small devices -->
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