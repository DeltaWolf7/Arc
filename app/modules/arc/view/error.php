<h1>Error <?php echo system\Helper::arcGetPostData("error"); ?></h1>
<div class="jumbotron">
    <p><i class="fa fa-warning"></i> 
        <?php
        

        switch (system\Helper::arcGetPostData("error")) {
            case "404":
                ?>
                The resource you're looking for cannot be found.<br />
                <br />Request URL: <?php echo system\Helper::arcGetPostData("path"); ?>
                <?php
                break;
            case "403":
                ?>
                You do not have permission to access this resource.<br />
                <?php
                break;
            case "401":
                ?>
                Your session has expired. Please login and try again.<br />
                <?php
                break;
            case "419":
                ?>
                Your authentication has expired. Please <a href="<?php echo system\Helper::arcGetPath() . "login"; ?>">login</a>.<br />
                <?php
                break;
            default:
                echo "Unhandled error occured: " . system\Helper::arcGetPostData("error");
                break;
        }
        ?>
    </p>
</div>






