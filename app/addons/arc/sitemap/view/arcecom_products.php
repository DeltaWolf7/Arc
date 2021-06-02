<div class="card mt-2">
    <div class="card-body">
        <h3>Ecommerce Generation - Products</h3>
        <?php

    $sitemap = file_get_contents(system\Helper::arcGetPath(true) . "sitemap.txt");
    echo "<br /><br />Adding Products</br >";
    $products = ArcEcomProduct::getAll();
    foreach ($products as $product) {
        $sitemap .= system\Helper::arcGetPath() . "products/" . $product->getSEOUrl() . PHP_EOL;
        echo system\Helper::arcGetPath() . "products/" . $product->getSEOUrl() . "<br />";
    }

    file_put_contents(system\Helper::arcGetPath(true) . "sitemap.txt", $sitemap);
    echo "<br />Complete adding products.";
?>
    </div>
</div>