<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php system\Helper::arcGetHeader(); ?>
    </head>
    <body>
        <!-- Outer Starts -->
        <div class="container-fluid container-fluid-nopad">

            <!-- Header two Starts -->
            <div class="header-2">

                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Logo section -->
                            <div class="logo">
                                <h1><a href="<?php echo system\Helper::arcGetPath(); ?>"><img src="<?php echo system\Helper::arcGetThemePath() . "images/logo.png"; ?>" alt="Arc Project"> Arc Project</a></h1>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <!-- Navigation starts.  -->
                            <div class="navy pull-right">			
                                <ul>
                                    <!-- Main menu -->
                                    <?php system\Helper::arcGetMenu(); ?>
                                </ul>
                            </div>							
                            <!-- Navigation ends -->

                        </div>

                    </div>
                </div>
            </div>

            <!-- Header two ends -->


            <!-- Main content starts -->

            <div class="main-block">
                <div class="container-fluid">