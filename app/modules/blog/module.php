<?php

$title = SystemSetting::getByKey("ARC_BLOG_TITLE");
if (!SystemSetting::keyExists("ARC_BLOG_TITLE")) {
    $title->value = "Latest News";
    $title->update();
}

$menutitle = SystemSetting::getByKey("ARC_BLOG_MENU_TITLE");
if (!SystemSetting::keyExists("ARC_BLOG_MENU_TITLE")) {
    $menutitle->value = "Blog";
    $menutitle->update();
}

$charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");
if (!SystemSetting::keyExists("ARC_BLOG_CHAR_LIMIT")) {
    $charCount->value = "600";
    $charCount->update();
}

$thumbWidth = SystemSetting::getByKey("ARC_BLOG_THUMB_WIDTH");
if (!SystemSetting::keyExists("ARC_BLOG_THUMB_WIDTH")) {
    $thumbWidth->value = "80";
    $thumbWidth->update();
}

$latest = SystemSetting::getByKey("ARC_BLOG_NOLATEST");
if (!SystemSetting::keyExists("ARC_BLOG_NOLATEST")) {
    $latest->value = "10";
    $latest->update();
}

$entries = SystemSetting::getByKey("ARC_BLOG_ENTRIES_PER_PAGE");
if (!SystemSetting::keyExists("ARC_BLOG_ENTRIES_PER_PAGE")) {
    $entries->value = "10";
    $entries->update();
}

system\Helper::arcAddMenuItem($menutitle->value, "fa-newspaper-o", false, null, null);