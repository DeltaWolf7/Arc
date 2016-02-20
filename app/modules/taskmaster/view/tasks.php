<div class="row text-right">
    <a class="btn btn-default btn-sm" onclick="edit(0)"><i class="fa fa-plus"></i> Create Task</a>
</div>
<div class="table">
    <table class="table table-striped">
        <thead>
            <tr><td>Created</td><td>Due</td><td>Owner</td><td>Description</td><td>Tags</td><td></td></tr>
        </thead>
        <tbody>
            <?php
            $tasks = TMTask::getAll();
            foreach ($tasks as $task) {
                echo "<tr>"
                . "<td>{$task->created}</td>"
                . "<td>";

                if ($task->due == "") {
                    echo " - ";
                } else {
                    echo $task->due;
                }

                echo "</td>"
                . "<td>";

                $user = new User();
                $user->getByID($task->owner);
                echo $user->getFullname();

                echo "</td>"
                . "<td>" . substr($task->description, 0, 100) . "</td>"
                . "<td>";

                $tags = explode(",", $task->tags);
                foreach ($tags as $tag) {
                    echo "<i class=\"label label-info\">{$tag}</i> ";
                }

                echo "</td>"
                . "<td class=\"text-right\">"
                . "<a class=\"btn btn-success btn-xs\" onclick=\"edit({$task->id})\"><i class=\"fa fa-pencil\"></i> Edit</a>"
                . "</td>"
                . "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <div class='input-group date' id='created'>
                                    <span class="input-group-addon">Created</span>
                                    <input type='text' class="form-control" disabled/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <div class='input-group date' id='due'>
                                    <span class="input-group-addon">Due</span>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Description</span>
                        <textarea id="description" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Tags</span>
                        <input id="tags" type="text" class="form-control" maxlength="255">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Assign To</span>
                        <select id="assign" class="form-control">
                            <?php
                            $users = User::getAllUsers();
                            foreach ($users as $user) {
                                echo "<option value=\"{$user->id}\" ";
                                if ($task->owner == $user->id) {
                                    echo "selected";
                                }
                                echo ">" . $user->getFullname() . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="save">Save</a>
                <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>