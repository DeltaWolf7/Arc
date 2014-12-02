<div class="page-header">
    <h1>Question Editor</h1>
</div>

<div class="well">
    Tip: Click the name of a group to show the group's contents. Clicking again will hide the contents.
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
                <div class="row">
                    <div class="col-md-7">
                        
                        <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $col; ?>" aria-expanded="false" aria-controls="collapse<?php echo $col; ?>">
                        <?php echo $group->name; ?>
                    </a>
                    
                </h4>
                        
                    </div>
                    <div class="col-md-5 text-right">
                        <button class="btn btn-default btn-xs" onclick="editGroup('<?php echo $group->id; ?>', '<?php echo $group->name; ?>')"><span class="fa fa-edit"></span> Rename</button> 
                        <button class="btn btn-danger btn-xs" onclick="deleteGroup('<?php echo $group->id; ?>', '<?php echo $group->name; ?>')"><span class="fa fa-close"></span> Delete</button> 
                        <button class="btn btn-success btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "results/" . $group->id; ?>'"><span class="fa fa-area-chart"></span> All Results</button> 
                        <button class="btn btn-warning btn-xs" onclick="window.location = '<?php echo arcGetModulePath() . "visible/" . $group->id; ?>'"><span class="fa fa-eye"></span> <?php if ($group->visible == 1) { echo "Showing"; } else { echo "Not Showing"; } ?></button>
                    </div>
                </div>
                
            </div>
            <div id="collapse<?php echo $col; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $col; ?>">
                <div class="panel-body">
                   
                        
                    <?php
                    $questions = Group::getQuestions($group->id);
                    $count = 1;
                    echo "<ul class=\"list-group\">";
                    foreach ($questions as $question) {
                        echo "<li class=\"list-group-item\">(Q" . $count . ") <a href=\"" . arcGetModulePath() . "question/" . $question->id . "\">" . html_entity_decode($question->question) . "</a></li>";
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

<!-- Edit Group /-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="editgroup">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="editButton" type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
      </div>
      <div class="modal-body" id="deleteBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        <button id="deleteButton" type="button" class="btn btn-danger">Yes</button>
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
    
    function deleteGroup(id, name) {
        var text = 'Are you sure you want to delete the group \'' + name + '\'?';
        var link = "window.location = '<?php echo arcGetModulePath() . "deletegroup/"; ?>" + id + "'";
        $('#deleteButton').attr("onclick", link);
        $('#deleteBody').html(text);
        $('#deleteModal').modal('show');
    }
    
    function editGroup(id, name) {
        var link = "ajax.send('POST', {action: 'editgroup', name: '#editgroup', id: '" + id + "'}, '<?php arcGetDispatch() ?>', updateGroup, true)";
        $('#editButton').attr("onclick", link);
        $('#editgroup').val(name);
        $('#editModal').modal('show');
    }
</script>