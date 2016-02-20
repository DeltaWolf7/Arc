<div class="row">
    <div class="col-md-2">
        <div class="list-group">
            <div class="list-group-item active">Me</div>
            <a onclick="getTasksByUser('New')" class="list-group-item">New</a>
            <a onclick="getTasksByUser('In Progress')" class="list-group-item">In Progress</a>
            <a onclick="getTasksByUser('Done')" class="list-group-item">Done</a>
            <div class="list-group-item active">Everybody</div>
            <a onclick="getStatusTasks('New')" class="list-group-item">New</a>
            <a onclick="getStatusTasks('In Progress')" class="list-group-item">In Progress</a>
            <a onclick="getStatusTasks('Done')" class="list-group-item">Done</a>
            <a onclick="getAllTasks()" class="list-group-item">All</a>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-11">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Search for</span>
                    <input id="search" type="text" class="form-control" maxlength="50" placeholder="tags, description or number">
                    <span class="input-group-btn">
                        <a class="btn btn-default" id="searchBtn"><i class="fa fa-search"></i></a>
                    </span>
                </div>
            </div>
                </div>
            <div class="col-md-1">
                <span class="input-group-btn text-right">
                        <a class="btn btn-default" id="sendBtn"><i class="fa fa-envelope"></i></a>
                    </span>
                <?php
                if (system\Helper::arcIsUserAdmin()) {
                    ?>
                <span class="input-group-btn text-right">
                        <a class="btn btn-default" id="settingsBtn"><i class="fa fa-cog"></i></a>
                    </span>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="table" id="data">
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
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
                        <input id="tags" type="text" class="form-control" maxlength="255" placeholder="seperate,with,commas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Assign To</span>
                                <select id="assign" class="form-control">
                                    <?php
                                    $users = User::getAllUsers();
                                    foreach ($users as $user) {
                                        echo "<option value=\"{$user->id}\">" . $user->getFullname() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Status</span>
                                <select id="stat" class="form-control">
                                    <option value="New">New</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Hours</span>
                                <input id="hours" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="saveBtn">Save</a>
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Settings</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Send Report To</span>
                        <input id="emails" type="text" class="form-control" maxlength="255" placeholder="seperate,with,commas">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="saveSettingsBtn">Save</a>
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>