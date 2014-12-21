<?php

$pages = Page::getAllPages();
foreach ($pages as $page) {
    if (ARCDEFAULTMODULE == "page" && ARCDEFAULTACTION != $page->seourl) {
        system\Helper::arcAddMenuItem($page->title, "fa-file-o", false, system\Helper::arcGetPath() . "page/" . $page->seourl, "Pages");
    }
}