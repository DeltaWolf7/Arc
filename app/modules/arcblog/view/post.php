<?php
$uri = system\Helper::arcGetURI();
$data = explode("/", $uri);
$blog = Blog::getBySEOUrl($data[count($data) - 1]);
$content = html_entity_decode($blog->content);
$actual_link = system\Helper::arcGetCurrentUrl();
$categories = $blog->getCategories();
$poster = $blog->getPoster();
$profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $poster->id);
?>

<div class="card mb-5 bg-faded p-2 widget-blog-post">
    <div class="cover">
    <?php
        if (!empty($blog->image)) {
            ?>
            
            <img class="card-img-top" src="<?php echo system\Helper::arcGetPath() . "assets/arcblog/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>">
            
            <?php
        }
    ?>
        <div class="cover-overlay">
            <img class="avatar-floating-left avatar avatar-circle avatar-xl" src="<?php echo system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value; ?>" alt="">
        </div>
    </div>

    <div class="card-block mt-4">
        <h5 class="mb-4"><?php echo $blog->title ?></h5>
        <!-- P CLASS: card-text /-->
        <?php echo $content; ?>
    </div>
</div>
