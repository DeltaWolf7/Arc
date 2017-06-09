<?php

    system\Helper::arcAddHeader("css", system\Helper::arcGetModulePath() . "css/post.css");

    $uri = system\Helper::arcGetURI();
    $data = explode("/", $uri);

    if (count($data) >= 2) {
        // check we have content
        if ($data[1] == "post") {
            $blog = Blog::getBySEOUrl($data[2]);
            $content = html_entity_decode($blog->content);
            $category = $blog->getCategory();
            $poster = $blog->getPoster();

            system\Helper::arcAddHeader("title", $blog->title);
            system\Helper::arcAddHeader("keywords", $blog->tags);
        }
        elseif ($data[1] == "category") {
            $category = BlogCategory::getBySEOUrl($data[2]);        

            system\Helper::arcAddHeader("title", $category->name);
        }
    } else {
        // no content, no page. Redirect away.
        system\Helper::arcRedirect();
    }

