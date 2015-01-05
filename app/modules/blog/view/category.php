<?php

if (!empty(system\Helper::arcGetURLData("data1"))) {
    $charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");   
    $category = BlogCategory::getBySEOUrl(system\Helper::arcGetURLData("data1"));
    $blogs = Blog::getAllByCategory($category->id);
    buildBlog($blogs, $charCount->value);
}
