<?php
$page = Page::getBySEOURL(arcGetURLData("data1"));
if (!empty($page->title)) {
    echo "<div class=\"page-header\"><h1>" . $page->title . "</h1></div>";
}

echo html_entity_decode($page->content);
?>