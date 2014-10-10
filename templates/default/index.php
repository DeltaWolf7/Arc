<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo arcGetPath(); ?>"><?php echo ARCTITLE; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php arcGetMenu(); ?>
            </div>
        </div>
    </nav>
    <?php arcGetContent(); ?>
    <p>
        <div id="status" style="display:none;" class="alert alert-success" role="alert"></div>
    </p>
</div>
