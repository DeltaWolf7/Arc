<?php

$imagePath = system\Helper::arcGetPath() . "assets/products/";
$products = [];
$search = $searchquery;


// sort
$sort = "az";
$sortBy = "name";
$sortOrd = "ASC";
if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
}

switch ($sort) {
    case "az":
        $sortBy = "name";
        $sortOrd = "ASC"; 
        break;
    case "za":
        $sortBy = "name";
        $sortOrd = "DESC"; 
        break;
    case "lh":
        $sortBy = "price";
        $sortOrd = "ASC"; 
        break;
    case "hl":
        $sortBy = "price";
        $sortOrd = "DESC"; 
        break;
}

if (!empty($search)) {
    $products = ArcEcomProduct::search($search, $sortBy, $sortOrd);
    system\Helper::arcAddHeader("title", "Search results for '" . $search. "'");
    $bread = "<li class=\"breadcrumb-item\"><a href=\"/categories\">Home</a></li>" 
        . PHP_EOL . "<li class=\"breadcrumb-item\">Search results for '" . $search . "'</li>";
}

?>

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
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Sort By
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item" onclick="sort('az')"><i class="fas fa-sort-alpha-down"></i> Name (A to
                        Z)</a>
                </li>
                <li><a class="dropdown-item" onclick="sort('za')"><i class="fas fa-sort-alpha-down-alt"></i> Name (Z
                        to
                        A)</a></li>
                <li><a class="dropdown-item" onclick="sort('lh')"><i class="fas fa-sort-numeric-down"></i> Price (Low
                        to
                        High)</a></li>
                <li><a class="dropdown-item" onclick="sort('hl')"><i class="fas fa-sort-numeric-down-alt"></i> Price
                        (High to Low)</a>
                </li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php

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
</div>
<?php
} else {

    ?>
<div class="card">
    <div class="card-body">
        <h2>Sorry, we didn't find what you were looking for..</h2>
    </div>
</div>

<?php
}
?>

<script>
function sort(mode) {
    window.location.href = "/search" + "?search=<?php echo $search; ?>&sort=" + mode;
}
</script>