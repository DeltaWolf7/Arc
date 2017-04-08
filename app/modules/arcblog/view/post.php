<?php
$uri = system\Helper::arcGetURI();
$data = explode("/", $uri);
$blog = Blog::getBySEOUrl($data[count($data) - 1]);
$content = html_entity_decode($blog->content);
$actual_link = system\Helper::arcGetCurrentUrl();
$categories = $blog->getCategories();
?>

<div class="media">
    <?php
    if (!empty($blog->image)) {
        ?>
        <a class="media-left" href="<?php echo $actual_link . "{$blog->seourl}"; ?>">
            <img class="img-rounded" src="<?php echo system\Helper::arcGetThumbImage($blog->image); ?>" alt="<?php echo $blog->title; ?>">
        </a>
        <?php
    }
    ?>
    <div class="media-body">
        <a href="<?php echo $actual_link . "{$blog->seourl}"; ?>">
            <h1 class="media-heading"><?php echo $blog->title ?></h1>
        </a>
        <?php echo $content; ?>
    </div>
    <hr />
    <div class="text-right">
        <?php if (isset($tags)) { ?> 
            <i class="fa fa-tags"></i> <?php echo $tags; ?>
        <?php } ?>
        <i class="fa fa-folder"></i> Posted in 
        <?php
        $count = count($categories);
        for ($i = 0; $i < $count; $i++) {
            if ($i != $count - 1) {
                echo "<a href=\"" . $actual_link . "category/{$categories[$i]->seourl}\">{$categories[$i]->name}</a>, ";
            } else {
                echo "<a href=\"" . $actual_link . "category/{$categories[$i]->seourl}\">{$categories[$i]->name}</a>";
            }
        }
        ?>
        on <i class="fa fa-clock-o"></i> <?php echo $blog->date ?>
        by <i class="fa fa-user"></i> <?php echo $blog->poster; ?>
    </div>
</div>
