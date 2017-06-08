<?php
    if ($data[1] == "post") {
        // profile image
        $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $poster->id);
?>

    <h1><?php echo $blog->title ?></h1>

        <div class="card mb-5 p-2 widget-blog-post">
            <div class="cover">
            <?php
                echo "<img class=\"card-img-top\" src=\"" . $blog->getImage() . "\" alt=\"{$blog->title}\">";

                if (strlen($profileImage->value) > 0) {
                    echo "<div class=\"cover-overlay\">"
                        . "<img class=\"avatar-floating-left avatar avatar-circle avatar-xl\" src=\""
                        . system\Helper::arcGetPath() . "assets/profile/{$profileImage->value}\" alt=\"{$poster->getFullname()}\">"
                        . "</div>";
                }
                ?>
            </div>

            <div class="card-block mt-4">
                <!-- P CLASS: card-text /-->
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
    } elseif ($data[1] == "category") {
        echo "<h1>" . $category->name . "</h1>";

        $blogs = Blog::getAllByCategoryID($category->id);
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
                    <img class="card-img-top" src="<?php echo $blog->getImage(); ?>" alt="<?php echo $blog->title; ?>">
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
    }