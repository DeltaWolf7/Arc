<?php require_once __DIR__ . "/bootstrap.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php arcGetHeader(); ?>
    </head>
    <body>
        <?php require_once arcGetPath(true) . arcGetTheme() . "/index.php"; ?>
    </body>
</html>