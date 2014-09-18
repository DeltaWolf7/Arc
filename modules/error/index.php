<?php
http_response_code(arcGetURLData('data'));
?>

<div class="page-header">
    <h1><?php echo arcGetURLData('data'); ?></h1>
</div>

<div class="jumbotron">
    <p><span class="fa fa-warning"></span> 
        <?php
        switch (arcGetURLData('data')) {
            case '404':
                echo 'The resource you\'re looking for cannot be found.';
                break;
            case '403':
                echo 'You do not have permission to access this resource.';
                break;
            case '419':
                echo 'Your authentication has expired. Please login in.';
                break;
        }
        ?>
    </p>
</div>






