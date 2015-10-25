<?php

function buildBlog($blog, $limit = 0) {
    $content = html_entity_decode($blog->content);
    if ($limit > 0 && strlen($blog->content) > $limit) {
        $content = substr($blog->content, 0, $limit - 1) . ".. <a href=\"" . system\Helper::arcGetModulePath() . "post/{$blog->seourl}\">Continue reading</a>";
    }

    $categories = $blog->getCategories();
    ?>

    <?php
    if (!empty($blog->image)) {
        ?>
        <div class="blogImage">
            <img class="img-responsive" src="<?php echo system\Helper::arcGetPath() . "images/{$blog->image}"; ?>" alt="<?php echo $blog->title; ?>">  
        </div>
        <?php
    }
    ?>
    <div class="media">

        <div class="media-body">
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
                        echo "<a href=\"" . system\Helper::arcGetModulePath() . "category/{$categories[$i]->seourl}\">{$categories[$i]->name}</a>, ";
                    } else {
                        echo "<a href=\"" . system\Helper::arcGetModulePath() . "category/{$categories[$i]->seourl}\">{$categories[$i]->name}</a>";
                    }
                }
                ?>
             on <i class="fa fa-clock-o"></i> <?php echo $blog->date ?>
        </div>
    </div>

    <?php
}