<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $page = new Page();
    $page->getByID($_POST["id"]);
    $page->content = htmlentities($_POST["html"]);
    $page->seourl = strtolower($_POST["seourl"]);
    $page->metadescription = $_POST["metadescription"];
    $page->metakeywords = $_POST["metakeywords"];
    $page->sortorder = $_POST["sortorder"];
    $page->iconclass = $_POST["iconclass"];
    $page->title = $_POST["title"];
    $seo = Page::getBySEOURL($_POST["seourl"]);
    if ($seo->id != 0 && $seo->id != $page->id) {
        system\Helper::arcAddMessage("danger", "Duplicate SEO Url found, please choose another");
        return;
    }
    $page->update();
    system\Helper::arcAddMessage("success", "Page saved");
}