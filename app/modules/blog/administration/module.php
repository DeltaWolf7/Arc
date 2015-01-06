<?php

system\Helper::arcAddMenuItem("Manager Blog", "fa-newspaper-o", false, null, "Administration");

$title = SystemSetting::getByKey("ARC_BLOG_TITLE");
if (empty($title->value)) {
    $title = new SystemSetting();
    $title->key = "ARC_BLOG_TITLE";
    $title->value = "Latest News";
    $title->update();
}

$charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");
if (empty($charCount->value)) {
    $charCount = new SystemSetting();
    $charCount->key = "ARC_BLOG_CHAR_LIMIT";
    $charCount->value = "600";
    $charCount->update();
}

$thumbWidth = SystemSetting::getByKey("ARC_BLOG_THUMB_WIDTH");
if (empty($thumbWidth->value)) {
    $thumbWidth = new SystemSetting();
    $thumbWidth->key = "ARC_BLOG_THUMB_WIDTH";
    $thumbWidth->value = "80";
    $thumbWidth->update();
}