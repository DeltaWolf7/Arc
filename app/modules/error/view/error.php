<div class="page-header">
    <h1><?php echo system\Helper::arcGetURLData("data1"); ?></h1>
</div>

<div class="jumbotron">
    <p><i class="fa fa-warning"></i> 
        <?php
        switch (system\Helper::arcGetURLData("data1")) {
            case "404":
                ?>
                The resource you're looking for cannot be found.<br />
                <?php
                break;
            case "403":
                ?>
                You do not have permission to access this resource.<br />
                <?php
                break;
            case "419":
                ?>
                Your authentication has expired. Please <a href="<?php echo system\Helper::arcGetPath() . "user/login"; ?>">login</a>.<br />
                <?php
                break;
            default:
                echo "Unhandled error occured: " . system\Helper::arcGetURLData("data1"); 
                break;
        }
        ?>
    </p>
</div>






