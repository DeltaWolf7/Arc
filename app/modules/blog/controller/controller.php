<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("default");
}

if (system\Helper::arcGetURLData("data1") == "post") {
    $blog = Blog::getBySEOUrl(system\Helper::arcGetURLData("data2"));
    system\Helper::arcAddHeader("title", $blog->title);
    system\Helper::arcAddHeader("keywords", $blog->tags);
    $charCount = 160;
    $content = $blog->content;
    if (strlen($blog->content) > $charCount) {
        $content = substr($blog->content, 0, $charCount - 1);
    }
    system\Helper::arcAddHeader("description", $content);
    system\Helper::arcAddHeader("", "<meta property=\"og:title\" content=\"" . $blog->title . "\" />" . PHP_EOL);
    system\Helper::arcAddHeader("", "\t<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL);
    system\Helper::arcAddHeader("", "\t<meta property=\"og:description\" content=\"" . $content . "\" />" . PHP_EOL);
    system\Helper::arcAddHeader("", "\t<meta property=\"og:url\" content=\"http://" . $_SERVER['HTTP_HOST'] . system\Helper::arcGetModulePath() . system\Helper::arcGetURLData("data1") . "/" . system\Helper::arcGetURLData("data2") . "/\" />" . PHP_EOL);
    if (!empty($blog->image)) {
        arcAddHeader("", "\t<meta property=\"og:image\" content=\"http://" . $_SERVER['HTTP_HOST'] . system\Helper::arcGetModulePath() . system\Helper::arcGetURLData("data1") . "/images/" . $blog->image . "\"/>" . PHP_EOL);
    }
    system\Helper::arcAddHeader("", "\t<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL);
}