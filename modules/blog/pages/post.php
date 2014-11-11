<?php
global $arc;
$category = new BlogCategory();
$category->getByID($blog->categoryid);

$poster = new User();
$poster->getByID($blog->posterid);
?>

<div class="panel panel-default">
    <div class="panel-body">
        <a href="<?php echo arcGetModulePath() . "/post/" . $blog->seourl ?>"><h3><?php echo $blog->title ?></h3></a>

        <?php
        if (!empty($blog->image)) {
            ?>
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="<?php echo arcGetModulePath() . "/post/" . $blog->seourl ?>"><img class="img-rounded" src="<?php echo arcGetPath() . "images/blog/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>" /></a>
                </div>
                <div class="col-md-9">             
                    <?php
                }
                ?>

                <?php
                echo $content;
                ?>

                <?php
                if (!empty($blog->image)) {
                    ?>
                </div></div>
            <?php
        }
        ?>
    </div>
    <?php if (isset($tags)) { ?> 
        <div class="panel-body text-right"><span class="fa fa-tags"></span> <?php echo $tags; ?></div>
    <?php } ?>
    <div class="panel-footer text-right"><span class="fa fa-folder"></span> Posted in <a href="<?php echo arcGetModulePath() . "/category/" . $category->seourl ?>"><?php echo $category->name ?></a> by <span class="fa fa-user"></span> <a href="<?php echo arcGetModulePath() . "/poster/" . $poster->id ?>"><?php echo $poster->firstname . " " . $poster->lastname; ?></a> on <span class="fa fa-clock-o"></span> <?php echo $blog->date ?>
    </div>
</div>
