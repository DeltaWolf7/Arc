<?php

if (system\Helper::arcIsAjaxRequest()) {
    $page = Page::getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["title" => $page->title, "seourl" => $page->seourl,
        "metadescription" => $page->metadescription, "metakeywords" => $page->metakeywords,
        "seourl" => $page->seourl, "html" => html_entity_decode($page->content),
        "sortorder" => $page->sortorder, "iconclass" => $page->iconclass,
        "showtitle" => $page->showtitle, "hidelogin" => $page->hideonlogin,
        "hidemenu" => $page->hidefrommenu, "theme" => $page->theme]);
}