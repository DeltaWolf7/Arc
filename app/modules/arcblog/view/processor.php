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
        echo $category->name;
    }