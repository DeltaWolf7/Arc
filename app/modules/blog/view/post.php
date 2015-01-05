<?php

if (!empty(system\Helper::arcGetURLData("data1"))) {
    $blog = Blog::getBySEOUrl(system\Helper::arcGetURLData("data1"));
    $blogs[] = $blog;
    buildBlog($blogs, 0);
} else {
    system\Helper::arcOverrideView("default");
}