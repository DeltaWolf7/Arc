
<?php

$latest = SystemSetting::getByKey("ARC_BLOG_NOLATEST");
$blogs = Blog::getLatest($latest->value);
$charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");


    if (count($blogs) == 0) {
        echo "No posts found in this category.";
    } else {
        foreach ($blogs as $blog) {
            $content = html_entity_decode($blog->content);
            $content = strtok(wordwrap($content, $charCount->value, "...\n"), "\n");         
            $category = $blog->getCategory();
            ?>

            <div class="card">
                <?php if (!empty($blog->image)) { ?>
                <img class="card-img-top" src="<?php echo $blog->getImage(); ?>" alt="<?php echo $blog->title; ?>">
                <?php } ?>
                <div class="card-body card-bottom-border">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text">
                            <a href="<?php echo $category->getUrl(); ?>"><span class="badge badge-pill badge-info">
                                <?php echo $category->name; ?>
                                </span></a>
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p class="card-text"><small class="text-muted">
                            <strong><?php
                                $date = date_create($blog->date);
                                echo date_format($date,"F d, Y");
                             ?></strong>
                            </small></p>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $blog->title; ?></h2>
                    <?php echo $content; ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <strong><a href="<?php echo $blog->getUrl(); ?>">READ MORE</a></strong>
                    </p>
                </div>
            </div>

            <?php
        }
    }