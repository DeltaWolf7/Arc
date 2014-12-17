<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php system\Helper::arcGetHeader(); ?>
    </head>         
    <body>    
        <div class="site-header">
            <div class="container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-8">
                            <div class="logo">
                                <a href="<?php echo system\Helper::arcGetPath(); ?>">
                                    <img src="<?php echo system\Helper::arcGetTemplatePath(); ?>images/logo.png" alt="<?php echo ARCTITLE; ?>" title="<?php echo ARCTITLE; ?>">
                                </a>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-4 -->
                        <div class="col-md-9 col-sm-8 col-xs-4">
                            <div class="main-menu">
                                <ul class="visible-lg visible-md">
                                    <?php system\Helper::arcGetMenu(); ?>
                                </ul>
                                <a href="#" class="toggle-menu visible-sm visible-xs">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div> <!-- /.main-menu -->
                        </div> <!-- /.col-md-8 -->
                    </div> <!-- /.row -->
                </div> <!-- /.main-header -->
                <div class="row">
                    <div class="col-md-12 visible-sm visible-xs">
                        <div class="menu-responsive">
                            <ul>
                                <?php system\Helper::arcGetMenu(); ?>
                            </ul>
                        </div> <!-- /.menu-responsive -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-header -->
        <?php
        $rnd = rand(1, 2);
        ?>
        <div class="page-top" id="templatemo" style="background-image: url('<?php echo system\Helper::arcGetTemplatePath() . "images/banner" . $rnd . ".jpg" ?>')">
        </div> <!-- /.page-header -->
        <div class="middle-content">
            <div class="container">
             

                