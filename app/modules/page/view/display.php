<?php
$page = Page::getBySEOURL(system\Helper::arcGetURLData("data1"));
if (!empty($page->title)) {
    echo "<div class=\"page-header\"><h1>{$page->title}</h1></div>";
}
$content = html_entity_decode($page->content);
preg_match_all('/{{widget:([^,]+?)}}/', $content, $matches);
foreach ($matches[1] as $key => $filename) {
    ob_start();
    system\Helper::arcGetWidget($filename);
    $newContent = ob_get_contents();
    ob_end_clean();
    $content = str_replace("{{widget:" . $filename . "}}", $newContent, $content);
}
echo $content;