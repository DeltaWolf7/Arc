<div class="page-header">
    <h1>Wall Manager</h1>
</div>

<?php
$posts = Post::getLatest(50);
foreach ($posts as $post) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $post->user; ?> said on <?php echo $post->posted; ?>
        </div>
        <div class="panel-body">
            <?php echo html_entity_decode($post->content); ?>
        </div>
        <div class="panel-footer text-right">
            <a href="<?php echo system\Helper::arcGetModulePath() . "delete/" . $post->id; ?>" class="btn btn-default btn-sm"><i class="fa fa-remove"></i> Delete</a>
        </div>
    </div>
    <?php
}
?>

