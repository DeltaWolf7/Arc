<ol class="breadcrumb hide-phone p-0 m-0">
    <li class="breadcrumb-item">
        <a href="<?php echo system\Helper::arcGetPath(); ?>">Home</a>
    </li>

    <?php
    $path = system\Helper::arcGetPath();
    $parts = "";
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
    $url = explode("/", $uri_parts[0]);
    foreach ($url as $part) {
        if (!empty($part)) {
            $parts .= $part;
            $page = Page::getBySEOURL($parts);
            $parts .= "/";
            if ($page->id != 0) {
                ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo $path . $parts; ?>"><?php echo $page->title ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="breadcrumb-item active">
                    <?php echo ucfirst($part); ?>
                </li>
                <?php
            }
        }
    }
    ?>
</ol>