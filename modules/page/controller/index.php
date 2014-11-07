<?php
$page = Page::getBySEOURL(arcGetURLData("module"));
if ($page->id == 0) {
    arcAddHeader("title", ARCTITLE);
} else {
    arcAddHeader("title", $page->metatitle);
}
arcAddHeader("description", $page->metadescription);
arcAddHeader("keywords", $page->metakeywords);
arcAddHeader("canonical", "/" . $page->seourl);
?>