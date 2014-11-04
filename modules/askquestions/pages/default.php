<div class="page-header">
    <h1>Questions</h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Question Groups</th><th>Details</th>
                </tr>
                <?php
                $groups = Group::getGroups();
                foreach ($groups as $group) {
                    $result = Result::getByGroupAndUserID($group->id, arcGetUser()->id);
                    $questions = Group::getQuestions($group->id);
                    echo "<tr><td><a href=\"" . arcGetModulePath() . "/group/" . $group->id . "\">" . $group->name . "</a> <button class=\"btn btn-success btn-xs\" onclick=\"window.location='" . arcGetModulePath() . "/results/" . $group->id . "'\"><span class=\"fa fa-area-chart\"></span> View Results</button></td><td>";
                    if (count($result) > 0) {
                        echo " <span class=\"label label-success\"><span class=\"fa fa-check\"></span> Times Completed: " . count($result) . "</span>";
                    }
                    echo " <span class=\"label label-primary\"><span class=\"fa fa-check\"></span> Number of Questions: " . count($questions) . "</span>";
                    echo "</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>