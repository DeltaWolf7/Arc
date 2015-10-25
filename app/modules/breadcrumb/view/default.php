<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home home-icon"></i>
            <a href="<?php echo system\Helper::arcGetPath(); ?>">Home</a>
        </li>

        <?php
        $path = system\Helper::arcGetPath();
        $url = explode("/", $_SERVER['REQUEST_URI']);
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