<div class="card">
    <div class="card-body">
        <h4 class="card-title">Error <?php echo http_response_code(); ?></h4>
        <p class="card-text"><br /><i class="fa fa-warning"></i>
        <?php
        switch (http_response_code()) {
            case "404":
                ?>
                The resource you're looking for cannot be found.<br />
                <br />Requested Url: <?php echo system\Helper::arcGetURI(); ?>
                <?php
                break;
            case "403":
                ?>
                You do not have permission to access this resource.<br />
                <br />
                If you have an account please <a href="<?php echo system\Helper::arcGetPath() . "login?redirect=" . $_SERVER['REQUEST_URI']; ?>">login</a> to continue.<br />
                <?php
                break;
            case "401":
                ?>
                Your session has expired. Please login and try again.
                <br />
                <br />
                Please <a href="<?php echo system\Helper::arcGetPath() . "login?redirect=" . $_SERVER['REQUEST_URI']; ?>">login</a> to continue.<br />
                <?php
                break;
            case "419":
                ?>
                Your authentication has expired. Please <a href="<?php echo system\Helper::arcGetPath() . "login"; ?>">login</a>.<br />
                <?php
                break;
            default:
                echo "Unhandled error occurred: " . http_response_code() . "<br />";
                break;
        }
        ?>
        </p>
    </div>
</div>







