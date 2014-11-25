<?php
$currenySymbol = SystemSetting::getByKey("ARC_STORE_CURRENCYSYMBOL");
$currenyDisplay = SystemSetting::getByKey("ARC_STORE_CURRENCYDISPLAY");
?>

<div class="container">
    <h3>Products</h3>
    <div class="text-right">
        <button type="button" class="btn btn-default btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "products/view/0"; ?>'"><span class="fa fa-plus"></span> New Product</button>
    </div>
    <p>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"><strong>Image</strong></div>
                <div class="col-md-3"><strong>SKU</strong></div>
                <div class="col-md-3"><strong>Name</strong></div>
                <div class="col-md-3"><strong>Price</strong></div>
            </div>



            <?php
            $products = Product::getProducts();
            foreach ($products as $product) {
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        echo "<img style=\"width: 80px; height: 80px;\" src=\"" . arcGetPath() . "images/products/";
                        if (!empty($product->image)) {
                            echo $product->image;
                        } else {
                            echo "noimage.png";
                        }
                        echo "\" alt=\"" . $product->name . "\" class=\"img-rounded\">";
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo $product->sku;
                        ?>
                    </div>
                    <div class="col-md-3"> 
                        <?php
                        echo $product->name;
                        ?>
                    </div>
                    <div class="col-md-3"> 
                        <?php
                        if ($currenyDisplay->setting == "Left") {
                            echo $currenySymbol->setting;
                        }
                        echo $product->price;
                        if ($currenyDisplay->setting == "Right") {
                            echo $currenySymbol->setting;
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</p>
</div>