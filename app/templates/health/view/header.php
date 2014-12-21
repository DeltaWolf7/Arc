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
            <a href="<?php echo system\Helper::arcGetPath(); ?>"><img src="<?php echo system\Helper::arcGetTemplatePath() . "images/logo.png" ?>" alt="<?php echo ARCTITLE; ?>" /></a>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php system\Helper::arcGetMenu(["page"]); ?>
                        </ul>
                    </div>
                </div>
            </nav>