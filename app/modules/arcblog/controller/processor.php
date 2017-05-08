<?php

    system\Helper::arcAddHeader("css", system\Helper::arcGetModulePath() . "css/post.css");

    $uri = system\Helper::arcGetURI();
    $data = explode("/", $uri);

    if ($data[1] == "post") {
        $blog = Blog::getBySEOUrl($data[2]);
        $content = html_entity_decode($blog->content);
        $categories = $blog->getCategories();
        $poster = $blog->getPoster();

        system\Helper::arcAddHeader("title", $blog->title);
    }
    elseif ($data[1] == "category") {
        $category = BlogCategory::getBySEOUrl($data[2]);        

        system\Helper::arcAddHeader("title", $category->name);
    }

