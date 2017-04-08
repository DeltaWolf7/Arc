<?php
if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("default");
    $title = SystemSetting::getByKey("ARC_BLOG_TITLE");
    system\Helper::arcAddHeader("title", $title->value);
    
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
        system\Helper::arcAddHeader("", "<meta property=\"og:title\" content=\"{$blog->title}\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:type\" content=\"Article\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:description\" content=\"{$content}\" />" . PHP_EOL);
        system\Helper::arcAddHeader("", "<meta property=\"og:url\" content=\"" . system\Helper::arcGetModulePath() . system\Helper::arcGetURLData("action") . "/" . system\Helper::arcGetURLData("data1") . "/\" />" . PHP_EOL);
        if (!empty($blog->image)) {
            system\Helper::arcAddHeader("", "<meta property=\"og:image\" content=\"" . system\Helper::arcGetPath() . "images/{$blog->image}\"/>" . PHP_EOL);
        }
        system\Helper::arcAddHeader("", "<meta property=\"og:site_name\" content=\"" . ARCTITLE . "\" />" . PHP_EOL);
    }
}