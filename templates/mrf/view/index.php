<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php arcGetHeader(); ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6"><a href="<?php echo arcGetPath(); ?>"><img src="<?php echo arcGetPath(); ?>images/logo.png" alt="<?php echo ARCTITLE; ?>" /></a></div>
                <div class="col-md-6 text-right"><h1>Call Today: 07551 015052</h1></div>
            </div>
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
                            <?php arcGetMenu(); ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php arcGetContent(); ?>
            <p>
            <div id="status" style="display:none;" class="alert alert-success" role="alert"></div>
        </p>
    </div>
        <?php arcGetFooter(); ?>
</body>
</html>