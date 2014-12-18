<div class="page-header">
    <h1><?php echo system\Helper::arcGetURLData("data1"); ?></h1>
</div>

<div class="jumbotron">
    <p><span class="fa fa-warning"></span> 
        <?php
        switch (system\Helper::arcGetURLData("data1")) {
            case "404":
                ?>
                The resource you're looking for cannot be found.<br />
                Request Module: '<?php echo system\Helper::arcGetURLData("data2"); ?>'
                <?php
                break;
            case "403":
                echo "You do not have permission to access this resource.";
                break;
            case "419":
                echo "Your authentication has expired. Please login.";
                break;
            default:
                break;
        }
        ?>
    </p>
</div>






