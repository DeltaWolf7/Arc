<?php
if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("default");
} elseif (system\Helper::arcGetURLData("action") == "post") {
    if (!empty(system\Helper::arcGetURLData("data1"))) {
        $blog = Blog::getBySEOUrl(system\Helper::arcGetURLData("data1"));
        system\Helper::arcAddHeader("title", $blog->title);
        system\Helper::arcAddHeader("keywords", $blog->tags);
        $charCount = 160;
        $content = $blog->content;
        if (strlen($blog->content) > $charCount) {
            $content = substr($blog->content, 0, $charCount - 1);
        }
        system\Helper::arcAddHeader("description", $content);
        system\Helper::arcAddHeader("", "<meta property=\"og:title\" content=\"" . $blog->title . "\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:description\" content=\"" . $content . "\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:url\" content=\"" . system\Helper::arcGetModulePath() . system\Helper::arcGetURLData("action") . "/" . system\Helper::arcGetURLData("data1") . "/\" />" . PHP_EOL);
        if (!empty($blog->image)) {
            system\Helper::arcAddHeader("", "<meta property=\"og:image\" content=\"" . system\Helper::arcGetModulePath() . system\Helper::arcGetURLData("data1") . "/images/" . $blog->image . "\"/>" . PHP_EOL);
        }
        system\Helper::arcAddHeader("", "<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL);
    }
}

function buildBlog($blogs, $limit = 0) {
    foreach ($blogs as $blog) {
        $content = $blog->content;
        if ($limit > 0 && strlen($blog->content) > $limit) {
            $content = substr($blog->content, 0, $limit - 1) . ".. <a href=\"" . system\Helper::arcGetModulePath() . "post/" . $blog->seourl . "\">Continue reading</a>";
        }

        $category = new BlogCategory();
        $category->getByID($blog->categoryid);
        ?>

        <div class="media">
        <?php
        if (!empty($blog->image)) {
            ?>
                <a class="media-left" href="<?php echo system\Helper::arcGetModulePath() . "post/" . $blog->seourl ?>">
                    <img class="img-rounded" src="<?php echo system\Helper::arcGetPath() . "images/blog/" . $blog->image; ?>" alt="<?php echo $blog->title; ?>">
                </a>
            <?php
        }
        ?>
            <div class="media-body">
                <a href="<?php echo system\Helper::arcGetModulePath() . "post/" . $blog->seourl ?>">
                    <h4 class="media-heading"><?php echo $blog->title ?></h4>
                </a>
        <?php echo $content; ?>
            </div>
            <hr />
            <div class="text-right">
        <?php if (isset($tags)) { ?> 
                    <span class="fa fa-tags"></span> <?php echo $tags; ?>
                <?php } ?>
                <span class="fa fa-folder"></span> Posted in <a href="<?php echo system\Helper::arcGetModulePath() . "category/" . $category->seourl ?>"><?php echo $category->name ?></a> on <span class="fa fa-clock-o"></span> <?php echo $blog->date ?>
            </div>
        </div>

        <?php
    }
}
