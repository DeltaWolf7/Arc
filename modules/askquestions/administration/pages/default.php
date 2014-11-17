<div class="page-header">
    <h1>Question Editor</h1>
</div>

<div class="well">
    Tip: Click the name of a group to show the groups contents. Clicking again will hide the contents.
</div>
<div class="text-right">
    <p>
        <button class="btn btn-primary btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "question/0"; ?>'"><span class="fa fa-plus"></span> New Question</button> <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> New Group</button>
    </p>
</div>
<?php
$groups = Group::getGroups();
$col = 0;
foreach ($groups as $group) {
    ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?php echo $col; ?>">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $col; ?>" aria-expanded="false" aria-controls="collapse<?php echo $col; ?>">
                        <?php echo $group->name; ?> <button class="btn btn-danger btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "deletegroup/" . $group->id; ?>'"><span class="fa fa-close"></span> Delete</button> <button class="btn btn-success btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "results/" . $group->id; ?>'"><span class="fa fa-area-chart"></span> View Results</button>
                    </a>
                </h4>
            </div>
            <div id="collapse<?php echo $col; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $col; ?>">
                <div class="panel-body">
                    <?php
                    $questions = Group::getQuestions($group->id);
                    $count = 1;
                    echo "<ul class=\"list-group\">";
                    foreach ($questions as $question) {
                        echo "<li class=\"list-group-item\">(Q" . $count . ") <a href=\"" . arcGetModulePath() . "question/" . $question->id . "\">" . $question->question . "</a></li>";
                        $count++;
                    }
                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $col++;
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">New Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="group">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'savegroup', name: '#group'}, '<?php arcGetDispatch() ?>', updateGroup, true);">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateGroup(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo arcGetModulePath(); ?>";
        }
        updateStatus(data);
    }
</script>