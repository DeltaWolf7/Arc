<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php arcGetHeader(); ?>
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo arcGetPath(); ?>">Rigby Transport and Travel</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <?php arcGetMenu(); ?>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            </nav>

            <div id="page-wrapper" style="background-image: url('<?php echo arcGetTheme(true) . "images/openroad.jpg"; ?>');">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">

                            <?php arcGetContent(); ?>
                            <?php arcGetStatus(); ?>

                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php arcGetFooter(); ?>
    </body>
</html>