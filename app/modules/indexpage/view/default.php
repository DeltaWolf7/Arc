<div class="list-group">
    <?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $pages = Page::getAllPages();
    $html = "<ul class=\"list-group\">";
    $s = str_replace("/", "", $url["path"]) . "/";
    foreach ($pages as $page) {
        $pos = strpos($page->seourl, $s);
        if ($pos !== false) {
            ?>

            <a href="<?php echo system\Helper::arcGetPath() . $page->seourl; ?>" class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo $page->title; ?></h4>
                <p class="list-group-item-text"><?php echo $page->metadescription; ?></p>
            </a>

            <?php
        }
    }
    ?>
</div>


