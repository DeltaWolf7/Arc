<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php arcGetHeader(); ?>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">        
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo"><a href="<?php echo arcGetPath(); ?>"><img src="<?php echo arcGetPath() . arcGetTheme() . "images/logo.png" ?>" alt="<?php echo ARCTITLE; ?>" /></a></div>
                </div>
                <div id="navbar" class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <?php arcGetMenu(); ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <!-- Begin page content -->
        <div class="container">
            <?php arcGetContent(); ?>
            <p>
            <div id="status" style="display:none;" class="alert alert-success" role="alert"></div>
        </p>
    </div>

    <div class="footer">
        <div class="container">
            <p class="text-muted">Grange Computer Supplies © 2014</p>
        </div>
    </div>
</body>
</html>