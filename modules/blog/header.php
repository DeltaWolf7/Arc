<?php
if (arcGetURLData("data1") == "post") {
    $blog = Blog::getBySEOUrl(arcGetURLData("data2"));
    $title = $blog->title;
    $metakeywords = $blog->tags;
    $charCount = 160;
    $content = $blog->content;
    if (strlen($blog->content) > $charCount) {
        $content = substr($blog->content, 0, $charCount - 1);
    }
    $metadescription = $content;
    
    echo "<meta property=\"og:title\" content=\"" . $title . "\" />" . PHP_EOL;
    echo "\t<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL;
    echo "\t<meta property=\"og:description\" content=\"" . $content . "\" />" . PHP_EOL;
    echo "\t<meta property=\"og:url\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . "/" . arcGetURLData("data1") . "/" . arcGetURLData("data2") . "/\" />" . PHP_EOL;
    if (!empty($blog->image)) {
        echo "\t<meta property=\"og:image\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . "/" . arcGetURLData("data1") . "/images/" . $blog->image . "\"/>" . PHP_EOL;
    }
    echo "\t<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL;

}
?>