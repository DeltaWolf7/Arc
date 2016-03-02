<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home home-icon"></i>
            <a href="<?php echo system\Helper::arcGetPath(); ?>">Home</a>
        </li>

        <?php
        $path = system\Helper::arcGetPath();
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $url = explode("/", $uri_parts[0]);
        foreach ($url as $part) {
            if (!empty($part)) {
                $path .= $part . "/";
                ?>
                <li>
                    <a href="<?php echo $path; ?>"><?php echo ucfirst($part); ?></a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>