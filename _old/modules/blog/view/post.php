<?php
global $arc;
$category = new BlogCategory();
$category->getByID($blog->categoryid);

$poster = new User();
$poster->getByID($blog->posterid);
?>


<div class="media">
    <?php
    if (!empty($blog->image)) {
        ?>
        <a class="media-left" href="<?php echo arcGetModulePath() . "post/" . $blog->seourl ?>">
            <img class="img-rounded" src="<?php echo arcGetPath() . "images/blog/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>">
        </a>
        <?php
    }
    ?>
    <div class="media-body">
        <a href="<?php echo arcGetModulePath() . "post/" . $blog->seourl ?>">
            <h4 class="media-heading"><?php echo $blog->title ?></h4>
        </a>
        <?php
        echo $content;
        ?>
    </div>
</div>
<?php if (isset($tags)) { ?> 
    <div class="panel-body text-right"><span class="fa fa-tags"></span> <?php echo $tags; ?></div>
<?php } ?>
<div class="panel-footer text-right"><span class="fa fa-folder"></span> Posted in <a href="<?php echo arcGetModulePath() . "category/" . $category->seourl ?>"><?php echo $category->name ?></a> by <span class="fa fa-user"></span> <a href="<?php echo arcGetModulePath() . "poster/" . $poster->id ?>"><?php echo $poster->firstname . " " . $poster->lastname; ?></a> on <span class="fa fa-clock-o"></span> <?php echo $blog->date ?>
</div>

