<?php
$currenySymbol = SystemSetting::getByKey("ARC_STORE_CURRENCYSYMBOL");
$currenyDisplay = SystemSetting::getByKey("ARC_STORE_CURRENCYDISPLAY");
?>

<div class="page-header">
    <h1>Store Products</h1>
</div>
<?php if (system\Helper::arcGetURLData("data3") == null) { ?>
    <div class="text-right">
        <p>
            <button type="button" class="btn btn-default btn-sm" onclick="window.location = '<?php echo system\Helper::arcGetModulePath() . "products/view/0"; ?>'"><span class="fa fa-plus"></span> New Product</button>
        </p>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>Image</td>
                <td>SKU</td>
                <td>Name</td>
                <td>Price</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <?php
        $products = Product::getProducts();
        foreach ($products as $product) {
            ?>
            <tr>
                <td>
                    <?php
                    echo "<a href=\"" . system\Helper::arcGetModulePath() . "products/view/" . $product->id . "\"><img src=\"" . system\Helper::arcGetPath() . "images/products/";
                    if (!empty($product->image)) {
                        echo $product->image;
                    } else {
                        echo "noimage.png";
                    }
                    echo "\" alt=\"" . $product->name . "\" class=\"img-thumbnail product-thumb\"></a>";
                    ?>
                </td>
                <td class="valign">
                    <a href="<?php echo system\Helper::arcGetModulePath() . "products/view/" . $product->id; ?>">
                        <?php echo $product->sku; ?>
                    </a>
                </td>
                <td class="valign">
                    <a href="<?php echo system\Helper::arcGetModulePath() . "products/view/" . $product->id; ?>">
                        <?php echo $product->name; ?>
                    </a>
                </td>
                <td class="valign">
                    <?php
                    if ($currenyDisplay->value == "Left") {
                        echo $currenySymbol->value;
                    }
                    echo $product->price;
                    if ($currenyDisplay->value == "Right") {
                        echo $currenySymbol->value;
                    }
                    ?>
                </td>
                <td class="valign text-right">
                    <button type="button" class="btn btn-default btn-xs" title="Edit" onclick="window.location = '<?php echo system\Helper::arcGetModulePath() . "products/view/" . $product->id; ?>'"><span class="fa fa-edit"></span></button>
                    <button type="button" class="btn btn-default btn-xs" title="Delete" onclick="ajax.send('POST', {action: 'deleteproduct', id: '<?php echo $product->id; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-close"></span></button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} elseif (system\Helper::arcGetURLData("data3") == "view") {
    $product = new Product();
    $product->getByID(system\Helper::arcGetURLData("data4"));
    ?>

    <div class="form-group">
        <label for="image">Image</label><br />
        <img src="<?php
        if (!empty($product->image)) {
            echo arcGetPath() . "images/products/" . $product->image;
        } else {
            echo arcGetPath() . "images/products/noimage.png";
        }
        ?>" class="img-thumbnail product-thumb" />
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Product name" value="<?php echo $product->name; ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" class="form-control" placeholder="Product description" rows="5"><?php echo $product->description; ?></textarea>
    </div>
    <div class="form-group">
        <label for="sku">SKU</label>
        <input type="text" class="form-control" id="sku" placeholder="Product SKU" value="<?php echo $product->sku; ?>">
    </div>
    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" class="form-control" id="model" placeholder="Product model" value="<?php echo $product->model; ?>">
    </div>
    <div class="form-group">
        <label for="seo">SEO Url</label>
        <input type="text" class="form-control" id="seo" placeholder="SEO Url" value="<?php echo $product->seourl; ?>">
    </div>
    <div class="form-group">
        <label for="metakeywords">Meta Keywords</label>
        <input type="text" class="form-control" id="metakeywords" placeholder="Meta keywords" value="<?php echo $product->metakeywords; ?>">
    </div>
    <div class="form-group">
        <label for="metadescription">Meta Description</label>
        <input type="text" class="form-control" id="metadescription" placeholder="Meta description" value="<?php echo $product->metadescription; ?>">
    </div>
    <div class="form-group">
        <label for="metatitle">Meta Title</label>
        <input type="text" class="form-control" id="metatitle" placeholder="Meta title" value="<?php echo $product->metatitle; ?>">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" placeholder="0.00" value="<?php echo $product->price; ?>">
    </div>
    <div class="form-group">
        <label for="taxable">Taxable</label>
        <select class="form-control" id="taxable">
            <option value="0" <?php
            if ($product->taxable == 0) {
                echo "selected";
            }
            ?>>No</option>
            <option value="1" <?php
            if ($product->taxable == 1) {
                echo "selected";
            }
            ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="keywords">Keywords</label>
        <input type="text" class="form-control" id="keywords" placeholder="keyword,keywords" value="<?php echo $product->keywords; ?>">
    </div>
    <div class="form-group text-right">
        <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'saveproduct', id: '<?php echo $product->id; ?>', name: '#name', description: '#description', sku: '#sku', model: '#model', seourl: '#seo', metakeywords: '#metakeywords', metadescription: '#metadescription', metatitle: '#metatitle', price: '#price', taxable: '#taxable', keywords: '#keywords'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</button>
        <button type="button" class="btn btn-danger" onclick="ajax.send('POST', {action: 'deleteproduct', id: '<?php echo $product->id; ?>'}, '<?php system\Helper::arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-remove"></span> Delete</button>
        <button type="button" class="btn btn-primary" onclick="window.location = '<?php echo system\Helper::arcGetModulePath() . "products" ?>'"><span class="fa fa-close"></span> Close</button>
    </div>
<?php } ?>