<?php
$page = Page::getBySEOURL(arcGetURLData("data1"));
?>

<div class="page-header">
    <h1><?php echo $page->title; ?></h1>
</div>
<?php echo html_entity_decode($page->content); ?>