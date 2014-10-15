<?php
$page = Page::getBySEOURL($GLOBALS["arc"]->getURLData("data1"));
?>

<?php if (!empty($page->title)) { echo "<div class=\"page-header\"><h1>". $page->title . "</h1></div>"; } ?>

<?php echo html_entity_decode($page->content); ?>