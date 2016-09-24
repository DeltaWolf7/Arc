<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $page = Page::getByID($_POST["id"]);
    $page->content = htmlentities($_POST["html"]);
    $page->seourl = strtolower($_POST["seourl"]);
    // trim / from start
    $page->seourl = ltrim($page->seourl, "/");
    
    if (empty($page->seourl)) {
        system\Helper::arcAddMessage("danger", "SEO url is a required field");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }
    
    $page->metadescription = $_POST["metadescription"];
    $page->metakeywords = $_POST["metakeywords"];
    $page->sortorder = $_POST["sortorder"];
    $page->iconclass = $_POST["iconclass"];
    $page->title = $_POST["title"];
    
    if ($page->title == "") {
        system\Helper::arcAddMessage("danger", "Page must have a title");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }
    
    if ($_POST["showtitle"] == "true") {
        $page->showtitle = true;
    } else {
        $page->showtitle = false;
    }
    
    if ($_POST["hidelogin"] == "true") {
        $page->hideonlogin = true;
    } else {
        $page->hideonlogin = false;
    }
    
    if ($_POST["hidemenu"] == "true") {
        $page->hidefrommenu = true;
    } else {
        $page->hidefrommenu = false;
    }

    $page->theme = $_POST["theme"];
    $seo = Page::getBySEOURL($_POST["seourl"]);
    if ($seo->id != 0 && $seo->id != $page->id) {
        system\Helper::arcAddMessage("danger", "Duplicate SEO Url found, please choose another");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }
    $page->update();
    system\Helper::arcAddMessage("success", "Page saved");
    system\Helper::arcReturnJSON(["status" => "success"]);
}