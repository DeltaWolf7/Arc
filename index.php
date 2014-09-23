<?php

if (!file_exists('config.php')) {
    header( 'Location: install/' ) ;
    exit();
}

require_once __DIR__ . '/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        arcGetHeader();
        ?>

        <!-- JavaScript -->
        <script src="<?php echo arcGetPath(); ?>js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/delta-ajax-1.0.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/status.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/jquery-hotkeys.min.js"></script>
        <script src="<?php echo arcGetPath(); ?>js/bootstrap-wysiwyg.min.js"></script>

        <!-- CSS -->
        <link href="<?php echo arcGetPath(); ?>css/status.min.css" rel="stylesheet">
        <link href="<?php echo arcGetPath(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo arcGetPath(); ?>css/<?php echo arcGetTheme(); ?>" rel="stylesheet"> 
        <link href="<?php echo arcGetPath(); ?>css/datepicker.min.css" rel="stylesheet"> 
        <link href="<?php echo arcGetPath(); ?>css/font-awesome.min.css" rel="stylesheet"> 
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo arcGetPath(); ?>"><?php echo ARCTITLE; ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php arcGetMenu(); ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <?php
            arcGetContent();
            ?>
            <p>
            <div id="status" style="display:none;" class="alert alert-success" role="alert"></div>
        </p>
    </div>
</body>
</html>