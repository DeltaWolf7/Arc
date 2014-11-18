<?php
if (arcGetURLData("data1") == "post") {
    $blog = Blog::getBySEOUrl(arcGetURLData("data2"));
    arcAddHeader("title", $blog->title);
    arcAddHeader("keywords", $blog->tags);
    $charCount = 160;
    $content = $blog->content;
    if (strlen($blog->content) > $charCount) {
        $content = substr($blog->content, 0, $charCount - 1);
    }
    arcAddHeader("description", $content);
    arcAddHeader("", "<meta property=\"og:title\" content=\"" . $blog->title . "\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:description\" content=\"" . $content . "\" />" . PHP_EOL);
    arcAddHeader("", "\t<meta property=\"og:url\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . arcGetURLData("data1") . "/" . arcGetURLData("data2") . "/\" />" . PHP_EOL);
    if (!empty($blog->image)) {
        arcAddHeader("", "\t<meta property=\"og:image\" content=\"http://" . $_SERVER['HTTP_HOST'] . arcGetModulePath() . arcGetURLData("data1") . "/images/" . $blog->image . "\"/>" . PHP_EOL);
    }
    arcAddHeader("", "\t<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL);
}