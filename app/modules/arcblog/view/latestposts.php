
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
            $ending = "<div class=\"mt-4 text-right\">"
                        . "<a href=\"" .  $blog->getUrl() . "\" class=\"btn btn-secondary text-muted\">Read More</a>"
                    . "</div>";

            $content = strtok(wordwrap($content, $charCount->value, "...\n"), "\n") . $ending;
            
            $category = $blog->getCategory();
            ?>


            <div class="card">
                <?php if (!empty($blog->image)) { ?>
                <img class="card-img-top" src="<?php echo $blog->getImage(); ?>" alt="<?php echo $blog->title; ?>">
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
                            <a href="<?php echo $category->getUrl(); ?>"><?php echo $category->name; ?></a>
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
                     <!-- Datetime /-->
                        <div style="margin-left: 10px;">
                            <i class="fa fa-clock-o"></i>
                            <span>
                                <?php
                                    echo system\Helper::arcConvertDateTime($blog->date);
                                ?>
                            </span>
                        </div>
                </div>

            </div>

            <?php
        }
    }