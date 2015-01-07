<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php system\Helper::arcGetHeader(); ?>
    </head>         
    <body>    
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <i class="sr-only">Toggle navigation</i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </button>
                        <a href="<?php echo system\Helper::arcGetPath(); ?>">
                                    <img height="50px" src="<?php echo system\Helper::arcGetTemplatePath(); ?>images/logo.png" alt="<?php echo ARCTITLE; ?>" title="<?php echo ARCTITLE; ?>">
                                </a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php system\Helper::arcGetMenu(); ?>
                        </ul>
                    </div>
                </div>
            </nav>
         
               <?php
        $rnd = rand(1, 2);
        ?>
        <div class="page-top" id="templatemo" style="background-image: url('<?php echo system\Helper::arcGetTemplatePath() . "images/banner" . $rnd . ".jpg" ?>')">
        </div> <!-- /.page-header -->
        
             

                