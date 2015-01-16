<?php

system\Helper::arcOverrideView("display", false, [system\Helper::arcGetURLData("action")]);
$page = Page::getBySEOURL(system\Helper::arcGetURLData("data1"));
if ($page->id == 0) {
    system\Helper::arcAddHeader("title", ARCTITLE); 
} else {
    system\Helper::arcAddHeader("title", $page->title);
}
system\Helper::arcAddHeader("description", $page->metadescription);
system\Helper::arcAddHeader("keywords", $page->metakeywords);
