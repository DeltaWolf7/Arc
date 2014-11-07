<div class="page-header">
    <h1>Question Editor</h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-striped">
            <tr>
                <th>Question Groups <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">New Group</button></th><th>Questions <button class="btn btn-primary btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "question/0"; ?>'">New Question</button></th>
            </tr>
            <?php
            $groups = Group::getGroups();
            foreach ($groups as $group) {
                echo "<tr><td>" . $group->name . " <button class=\"btn btn-danger btn-xs\" onclick=\"window.location='" . arcGetModulePath() . "deletegroup/" . $group->id . "'\"><span class=\"fa fa-close\"></span> Delete</button> <button class=\"btn btn-success btn-xs\" onclick=\"window.location='" . arcGetModulePath() . "results/" . $group->id . "'\"><span class=\"fa fa-area-chart\"></span> View Results</button></td><td>";

                $questions = Group::getQuestions($group->id);
                $count = 1;
                echo "<ul class=\"list-group\">";
                foreach ($questions as $question) {
                    echo "<li class=\"list-group-item\">(Q" . $count . ") <a href=\"" . arcGetModulePath() . "question/" . $question->id . "\">" . $question->question . "</a></li>";
                    $count++;
                    //if ($count == 6) {
                    //    $no = count($questions) - 5;
                    //    if ($no > 0) {
                     //       echo "<li class=\"list-group-item\">Plus " . $no . " more question(s)..</li>";
                    //    }
                    //    break;
                    //}
                }
                echo "</ul>";
                echo "</td></tr>";
            }
            ?>
        </table>
    </div>
</div>


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