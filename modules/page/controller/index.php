<?php
global $page;
$page = Page::getBySEOURL(arcGetURLData("data1"));
if (empty($page->metatitle)) {
    arcAddHeader("title", ARCTITLE);
} else {
    arcAddHeader("title", $page->metatitle);
}
arcAddHeader("description", $page->metadescription);
arcAddHeader("keywords", $page->metakeywords);
arcAddHeader("canonical", "/" . $page->seourl);
?>