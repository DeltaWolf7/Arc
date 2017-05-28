
<?php

$latest = SystemSetting::getByKey("ARC_BLOG_NOLATEST");
$blogs = Blog::getLatest($latest->value);
$charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");


    if (count($blogs) == 0) {
        echo "No posts found in this category.";
    } else {
        foreach ($blogs as $blog) {
            $poster = $blog->getPoster();
            $content = html_entity_decode($blog->content);
            $actual_link = system\Helper::arcGetPath();

            $ending = "<div class=\"mt-4 text-right\">"
                        . "<a href=\"" .  $actual_link . "blog/post/" .  $blog->seourl . "\" class=\"btn btn-secondary text-muted\">Read More</a>"
                    . "</div>";

            $content = strtok(wordwrap($content, $charCount->value, "...\n"), "\n") . $ending;
            
            $category = $blog->getCategory();
            ?>


            <div class="card">
                <?php if (!empty($blog->image)) { ?>
                <img class="card-img-top" src="<?php echo system\Helper::arcGetPath() . "assets/arcblog/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>">
                <?php } ?>
                <div class="card-block border-b-1">
                    <h5><?php echo $blog->title; ?></h5>
                    <?php echo $content; ?>
                </div>

                <div class="d-flex px-4 py-3">
                    <!-- Category /-->
                    <div>
                        <i class="fa fa-folder-o"></i>
                        <span>
                            <?php echo $category->name; ?>
                        </span>
                    </div>
                    <!-- Poster /-->
                     <div style="margin-left: 10px;">
                        <i class="fa fa-user-o"></i>
                        <span>
                            <?php
                            echo $poster->getFullname();
                            ?>
                        </span>
                    </div>
                </div>

            </div>

            <?php
        }
    }