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
                <?php
                break;
            case "403":
                ?>
                You do not have permission to access this resource.<br />
                <?php
                break;
            case "419":
                ?>
                Your authentication has expired. Please login.<br />

                <?php
                break;
            default:
                break;
        }
        ?>
        Requested Module: '<?php echo system\Helper::arcGetURLData("data2"); ?>'<br />
    </p>
</div>






