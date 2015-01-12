<?php

function buildBlog($blog, $limit = 0) {
    $content = html_entity_decode($blog->content);
    if ($limit > 0 && strlen($blog->content) > $limit) {
        $content = substr($blog->content, 0, $limit - 1) . ".. <a href=\"" . system\Helper::arcGetModulePath() . "post/" . $blog->seourl . "\">Continue reading</a>";
    }

    $categories = $blog->getCategories();
    ?>

    <div class="media">
        <?php
        if (!empty($blog->image)) {
            ?>
            <a class="media-left" href="<?php echo system\Helper::arcGetModulePath() . "post/" . $blog->seourl ?>">
                <img class="img-rounded" src="<?php echo system\Helper::arcGetPath() . "app/modules/blog/images/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>">
            </a>
            <?php
        }
        ?>
        <div class="media-body">
            <?php echo $content; ?>
        </div>
        <hr />
        <div class="text-right">
            <?php if (isset($tags)) { ?> 
                <i class="fa fa-tags"></i> <?php echo $tags; ?>
            <?php } ?>
            <i class="fa fa-folder"></i> Posted in <a href="<?php echo system\Helper::arcGetModulePath() . "category/" . $category->seourl ?>">
                <?php 
                $count = count($categories);
                    for ($i = 0; $i < $count; $i++) {
                        if ($i != $count - 1) {
                            echo "<a href=\"" . system\Helper::arcGetModulePath() . "category/" . $categories[$i]->seourl . "\">" . $categories[$i]->name . "</a>, ";
                        } else {
                            echo "<a href=\"" . system\Helper::arcGetModulePath() . "category/" . $categories[$i]->seourl . "\">" . $categories[$i]->name . "</a>";
                        }
                    }
                ?>
            </a> on <i class="fa fa-clock-o"></i> <?php echo $blog->date ?>
        </div>
    </div>

    <?php
}