<?php
    if ($data[1] == "post") {
        // profile image
        $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $poster->id);
?>
        <div class="card mb-5 bg-faded p-2 widget-blog-post">
            <div class="cover">
            <?php
                if (!empty($blog->image)) {
                echo "<img class=\"card-img-top\" src=\"" . system\Helper::arcGetPath() . "assets/arcblog/{$blog->image}\" alt=\"{$blog->title}\">";
                }

                if (strlen($profileImage->value) > 0) {
                    echo "<div class=\"cover-overlay\">"
                        . "<img class=\"avatar-floating-left avatar avatar-circle avatar-xl\" src=\""
                        . system\Helper::arcGetPath() . "assets/profile/{$profileImage->value}\" alt=\"{$poster->getFullname()}\">"
                        . "</div>";
                }
                ?>
            </div>

            <div class="card-block mt-4">
                <h5 class="mb-4"><?php echo $blog->title ?></h5>
                <!-- P CLASS: card-text /-->
                <?php echo $content; ?>
            </div>
        </div>

       <?php
    } elseif ($data[1] == "category") {
        echo "<h1>" . $category->name . "</h1>";

        $blogs = Blog::getAllByCategory($category->name);
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
                
                $categories = $blog->getCategories();
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
                                <?php
                                foreach ($categories as $category) {
                                    echo $category->name . " ";
                                }
                                ?>
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
    }